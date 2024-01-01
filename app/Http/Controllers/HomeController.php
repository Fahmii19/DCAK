<?php

namespace App\Http\Controllers;

// import model CalonPemilih
use App\Models\CalonPemilih;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CalonPemilihImport;
use App\Imports\PemilihImport;
use App\Imports\SaksiTpsImport;
use App\Models\Pemilih;
use App\Models\User_dcak;
use App\Models\Koordinator;
use App\Models\Kelurahan;
use App\Models\Kecamatan;
use App\Models\SaksiTPS;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\WorksheetDrawingExt;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing as WorksheetMemoryDrawing;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade as PDF;


use ZipArchive;

use Illuminate\Support\Str;





// middleware
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Carbon\Carbon;


use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('CheckAdmin')->only('adminMethod');
        $this->middleware('CheckSuperAdmin')->only('superAdminMethod');
    }

    // Form Inputan
    public function formPemilih(Request $request)
    {
        return view('user-dcak.inputan');
    }

    public function getChartData(Request $request)
    {
        // array kecamatan dalam kelurahan
        $kecamatanKelurahanMapping = [
            'Tapos' => ['JATIJAJAR', 'SUKATANI', 'SUKAMAJU BARU', 'TAPOS', 'CIMPAEUN', 'CILANGKAP', 'LEUWINANGGUNG'],
            'Cilodong' => ['KALIMULYA', 'JATIMULYA', 'KALIBARU', 'CILODONG', 'SUKAMAJU'],
        ];

        // Mendefinisikan array dengan 20 warna yang berbeda
        $colors = [
            '#FF5733', '#33FF57', '#3366FF', '#FF33A1', '#FF5733', '#33FF57', '#3366FF',
            '#FF5733', '#33FF57', '#3366FF', '#FF33A1', '#FF5733', '#33FF57', '#3366FF',
            '#FF5733', '#33FF57', '#3366FF', '#FF33A1', '#FF5733', '#33FF57',
        ];


        // Mengambil data pemilih dan mengelompokkannya berdasarkan kelurahan
        $jumlahPemilihPerKelurahan = Pemilih::select('kelurahan', DB::raw('count(*) as total'))
            ->whereIn('kelurahan', array_merge(...array_values($kecamatanKelurahanMapping)))
            ->groupBy('kelurahan')
            ->get()
            ->pluck('total', 'kelurahan') // Mengambil total dan kelurahan sebagai key
            ->toArray();

        // Menyusun data untuk chart
        $data = [
            'labels' => array_keys($jumlahPemilihPerKelurahan), // Label kelurahan
            'datasets' => [
                [
                    'data' => array_values($jumlahPemilihPerKelurahan), // Jumlah pemilih
                    'backgroundColor' => [
                        'red', 'green', 'blue', 'orange', 'purple',
                        'pink', 'yellow', 'cyan', 'magenta', 'lime',
                        'teal', 'indigo', 'brown', 'gray', 'violet',
                        'lavender', 'maroon', 'gold', 'silver'
                    ],
                    // Warna bagian-bagian chart
                ],
            ],
        ];

        return response()->json($data);
    }


    // login

    public function getAllUsers()
    {
        $users       = (new User_dcak())->all();
        return response()->json($users, 200);
    }

    public function loginDcak(Request $request)
    {
        // proses login
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::users_dcak();
            if ($user->isAdmin()) {
                return redirect('/admin');
            }
            if ($user->isSuperAdmin()) {
                return redirect('/superadmin');
            }
        }
        return redirect('/login');
    }


    // Akun dcak
    public function akunDcak(Request $request)
    {
        return view('dcak.akun-dcak.index');
    }

    public function tableAkunDcak()
    {
        $akunDcaks = User_dcak::with('koordinator')->get();
        // dd($akunDcaks);
        return DataTables::of($akunDcaks)
            ->editColumn('koordinator.nama_koordinator', function ($akunDcak) {
                return $akunDcak->koordinator ? $akunDcak->koordinator->nama_koordinator : 'N/A';
            })
            ->editColumn('koordinator.kelurahan', function ($akunDcak) {
                return $akunDcak->koordinator ? $akunDcak->koordinator->kelurahan : 'N/A';
            })
            ->make(true);
    }

    public function inputAkunDcak(Request $request)
    {
        // koordinator
        $koordinator = Koordinator::all();
        $userKoordinators = User_dcak::pluck('id_koordinator')->toArray();

        return view('dcak.akun-dcak.input', compact('koordinator', 'userKoordinators'));
    }

    public function formInputAkunDcak(Request $request)
    {


        if ($request->level == 'superadmin') {
            // Cek apakah role sudah ada
            $superadminRole = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']);

            $userDcak = new User_dcak();
            $userDcak->username = $request->username;
            $userDcak->password = bcrypt($request->password);
            $userDcak->id_koordinator = $request->koordinator;
            $userDcak->level = $request->level;
            $userDcak->save();
            $userDcak->assignRole($superadminRole);
        } elseif ($request->level == 'admin') {
            // Cek apakah role sudah ada
            $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

            $userDcak = new User_dcak();
            $userDcak->username = $request->username;
            $userDcak->password = bcrypt($request->password);
            $userDcak->id_koordinator = $request->input('koordinator');
            $userDcak->level = $request->level;
            $userDcak->save();
            $userDcak->assignRole($adminRole);
        }

        return redirect()->route('akun-dcak')->with('success', 'Data akun dcak berhasil disimpan.');
    }

    public function editAkunDcak($id)
    {
        $akunDcak = User_dcak::with('koordinator')->find($id);
        return response()->json($akunDcak);
    }

    public function formEditAkunDcak(Request $request, $id)
    {
        // Update for table akun_dcak
        $akunDcak = User_dcak::find($id);
        $akunDcak->id_koordinator = $request->id_koordinator;
        $akunDcak->username = $request->username;
        $akunDcak->password = bcrypt($request->password);
        $akunDcak->level = $request->level;
        $akunDcak->save();

        // Find the related koordinator
        $koordinator = Koordinator::find($akunDcak->id_koordinator);
        if ($koordinator) {
            // Update for table koordinator
            $koordinator->nama_koordinator = $request->nama_koordinator;
            $koordinator->save();
        } else {
            // Handle the case where the koordinator doesn't exist
            // Maybe return an error message or do some other error handling
            return redirect()->route('akun-dcak')->with('error', 'Koordinator not found.');
        }

        return redirect()->route('akun-dcak')->with('success', 'Data akun dcak berhasil diupdate.');
    }


    public function deleteAkunDcak($id)
    {
        $akunDcak = User_dcak::find($id);
        if ($akunDcak) {
            $akunDcak->delete();
            return response()->json(['success' => true, 'message' => 'Data akun dcak berhasil dihapus.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Data akun dcak tidak ditemukan.']);
        }
    }


    // Landing Page
    public function landingPage(Request $request)
    {
        return view('landing-page.home');
    }

    // Saksi TPS
    public function saksiTps(Request $request)
    {
        return view('dcak.saksi_tps.index');
    }

    public function tableSaksiTps()
    {
        $saksiTps = SaksiTps::select(['id_saksi_tps', 'nama_saksi', 'nik', 'no_hp', 'rt', 'rw', 'no_tps', 'kelurahan', 'kecamatan', 'jumlah_suara', 'gambar']);
        return DataTables::of($saksiTps)->make(true);
    }

    // inputSaksiTps
    public function inputSaksiTps(Request $request)
    {
        return view('dcak.saksi_tps.input');
    }

    // formInputSaksiTps
    public function formInputSaksiTps(Request $request)
    {

        $saksiTps = new SaksiTps();
        $saksiTps->nama_saksi = $request->nama_saksi;
        $saksiTps->nik = $request->nik;
        $saksiTps->no_hp = $request->no_hp;
        $saksiTps->rt = $request->rt;
        $saksiTps->rw = $request->rw;
        $saksiTps->no_tps = $request->no_tps;
        $saksiTps->kelurahan = $request->kelurahan;
        $saksiTps->kecamatan = $request->kecamatan;
        $saksiTps->jumlah_suara = $request->jumlah_suara;

        // Handle file upload
        if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
            $folderPath = public_path('images/saksi_tps');

            // Check if folder exists, create if not
            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, $mode = 0755, true, true);
            }

            $filename = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move($folderPath, $filename); // Move file to the target folder
            $saksiTps->gambar =  $filename; // Update the path in the database
        }
        // dd($saksiTps);
        $saksiTps->save();

        return redirect()->route('saksi-tps')->with('success', 'Data saksi tps berhasil disimpan.');
    }



    function editSaksiTps($id)
    {
        $saksiTps = SaksiTps::find($id);
        return response()->json($saksiTps);
    }

    public function formEditSaksiTps(Request $request, $id)
    {
        $saksiTps = SaksiTps::find($id);

        // Handling file if a new file is uploaded
        if ($request->hasFile('gambar')) {
            // Add validation, storage, etc.
            $filename = $request->gambar->getClientOriginalName();
            $request->gambar->move(public_path('images/saksi_tps'), $filename);
            $saksiTps->gambar = $filename; // Saving the filename to the database
        }

        $saksiTps->nama_saksi = $request->nama_saksi;
        $saksiTps->nik = $request->nik;
        $saksiTps->no_hp = $request->no_hp;
        $saksiTps->rt = $request->rt;
        $saksiTps->rw = $request->rw;
        $saksiTps->no_tps = $request->no_tps;
        $saksiTps->kelurahan = $request->kelurahan;
        $saksiTps->kecamatan = $request->kecamatan;
        $saksiTps->jumlah_suara = $request->jumlah_suara;
        $saksiTps->save();

        return response()->json(['success' => true]);
    }


    function deleteSaksiTps($id)
    {
        $saksiTps = SaksiTps::find($id);
        if ($saksiTps) {
            // Jika perlu, hapus file gambar dari server di sini
            if (File::exists(public_path('images/saksi_tps/' . $saksiTps->gambar))) {
                File::delete(public_path('images/saksi_tps/' . $saksiTps->gambar));
            }

            $saksiTps->delete();
            return response()->json(['success' => true, 'message' => 'Data saksi tps berhasil dihapus.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Data saksi tps tidak ditemukan.']);
        }
    }



    public function importExcelSaksiTps(Request $request)
    {
        $file = $request->file('excel_file');
        $path = $file->getPathName();
        $extractFolder = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'saksi_tps');

        // Unzip the Excel file
        $zip = new ZipArchive;
        if ($zip->open($path) === TRUE) {
            $zip->extractTo($extractFolder);
            $zip->close();
            Log::info('Excel file extracted to: ' . $extractFolder);
        } else {
            Log::error('Failed to extract Excel file');
            return response()->json(['error' => 'Failed to extract Excel file']);
        }

        $files = glob($extractFolder . DIRECTORY_SEPARATOR . 'xl' . DIRECTORY_SEPARATOR . 'media' . DIRECTORY_SEPARATOR . '*');
        Log::info('Extracted media files: ', $files);

        // Move images to a specific folder and get the URLs
        $imageUrls = [];
        foreach ($files as $index => $file) {
            $filename = basename($file);
            Log::info('Processing file: ' . $filename);

            // Adding a timestamp to make each filename unique
            $newFilename = time() . '_' . $filename;

            // Ensure the destination directory exists
            $destinationDirectory = public_path('images' . DIRECTORY_SEPARATOR . 'saksi_tps' . DIRECTORY_SEPARATOR);
            if (!is_dir($destinationDirectory)) {
                mkdir($destinationDirectory, 0777, true);
            }

            // Move file to the destination directory
            if (rename($file, $destinationDirectory . $newFilename)) {
                Log::info('File moved: ' . $newFilename);
                $imageUrls[$index] = asset('images' . DIRECTORY_SEPARATOR . 'saksi_tps' . DIRECTORY_SEPARATOR . $newFilename);
            } else {
                Log::error('Failed to move file: ' . $filename);
                $imageUrls[$index] = null;  // Set null if fail to move
            }
        }

        // Clean up the temporary folder
        $this->deleteDirectory($extractFolder . DIRECTORY_SEPARATOR . 'xl');

        // Import data into the database
        Excel::import(new SaksiTpsImport($imageUrls), $path);

        return back()->with('success', 'Data and Images have been imported successfully!');
    }






    private function deleteDirectory($dirPath)
    {
        if (is_dir($dirPath)) {
            $objects = scandir($dirPath);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dirPath . DIRECTORY_SEPARATOR . $object)) {
                        $this->deleteDirectory($dirPath . DIRECTORY_SEPARATOR . $object);
                    } else {
                        unlink($dirPath . DIRECTORY_SEPARATOR . $object);
                    }
                }
            }
            rmdir($dirPath);
        }
    }





















    // Calon Pemilih
    public function calonPemilih(Request $request)
    {
        return view('dcak.calon-pemilih.index');
    }

    public function tableCalonPemilih()
    {
        $calonPemilih = CalonPemilih::select(['id_calon_pemilih', 'nik', 'nama_pemilih', 'jenis_kelamin', 'no_hp', 'rt', 'rw', 'tps', 'kelurahan']);
        return DataTables::of($calonPemilih)->make(true);
    }

    public function inputCalonPemilih(Request $request)
    {
        // get data kelurahan
        $kelurahan = Kelurahan::all();

        return view('dcak.calon-pemilih.input', compact('kelurahan'));
    }

    public function formInputCalonPemilih(Request $request)
    {
        $calonPemilih = new CalonPemilih();
        $calonPemilih->nik = $request->nik;
        $calonPemilih->nama_pemilih = $request->nama_pemilih;
        $calonPemilih->jenis_kelamin = $request->jenis_kelamin;
        $calonPemilih->no_hp = $request->no_hp;
        $calonPemilih->rt = $request->rt;
        $calonPemilih->rw = $request->rw;
        $calonPemilih->tps = $request->tps;
        $calonPemilih->kelurahan = $request->kelurahan;
        $calonPemilih->save();

        return redirect()->route('calon-pemilih')->with('success', 'Data calon pemilih berhasil disimpan.');
    }

    public function importExcelCalonPemilih(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx',
        ]);

        $file = $request->file('excel_file');

        try {
            Excel::import(new CalonPemilihImport(), $file);
            return redirect()->route('calon-pemilih')->with('success', 'Data berhasil diimpor dari Excel.');
        } catch (\Exception $e) {
            return redirect()->route('calon-pemilih')->with('error', 'Terjadi kesalahan saat mengimpor data dari Excel: ' . $e->getMessage());
        }
    }

    function editCalonPemilih($id)
    {
        // dd($id);
        $calonPemilih = CalonPemilih::find($id);
        return response()->json($calonPemilih);
    }

    function formEditCalonPemilih(Request $request, $id)
    {
        $calonPemilih = CalonPemilih::find($id);
        $calonPemilih->nik = $request->nik;
        $calonPemilih->nama_pemilih = $request->nama_pemilih;
        $calonPemilih->jenis_kelamin = $request->jenis_kelamin;
        $calonPemilih->no_hp = $request->no_hp;
        $calonPemilih->rt = $request->rt;
        $calonPemilih->rw = $request->rw;
        $calonPemilih->tps = $request->tps;
        $calonPemilih->kelurahan = $request->kelurahan;
        $calonPemilih->save();

        return redirect()->route('calon-pemilih')->with('success', 'Data calon pemilih berhasil diupdate.');
    }

    function deleteCalonPemilih($id)
    {
        $calonPemilih = CalonPemilih::find($id);
        if ($calonPemilih) {
            $calonPemilih->delete();
            return response()->json(['success' => true, 'message' => 'Data calon pemilih berhasil dihapus.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Data calon pemilih tidak ditemukan.']);
        }
    }

    // Function Koordinator
    function koordinator(Request $request)
    {
        return view('dcak.koordinator.index');
    }

    function totalSuara()
    {
        // array kecamatan dalam kelurahan
        $kecamatanKelurahanMapping = [
            'Tapos' => ['JATIJAJAR', 'SUKATANI', 'SUKAMAJU BARU', 'TAPOS', 'CIMPAEUN', 'CILANGKAP', 'LEUWINANGGUNG'],
            'Cilodong' => ['KALIMULYA', 'JATIMULYA', 'KALIBARU', 'CILODONG', 'SUKAMAJU'],
        ];

        // Mengambil data pemilih dan mengelompokkannya berdasarkan kelurahan
        $jumlahPemilihPerKelurahan = Pemilih::select('kelurahan', DB::raw('count(*) as total'))
            ->whereIn('kelurahan', array_merge(...array_values($kecamatanKelurahanMapping)))
            ->groupBy('kelurahan')
            ->get()
            ->keyBy('kelurahan');

        $jumlahPemilihPerKelurahanPerkecamatan = [];
        $jumlahTotalPerKecamatan = [];

        foreach ($kecamatanKelurahanMapping as $kecamatan => $kelurahans) {
            $totalPerKecamatan = 0;

            foreach ($kelurahans as $kelurahan) {
                $jumlahPemilih = isset($jumlahPemilihPerKelurahan[$kelurahan]) ? $jumlahPemilihPerKelurahan[$kelurahan]->total : 0;
                $jumlahPemilihPerKelurahanPerkecamatan[$kecamatan][$kelurahan] = $jumlahPemilih;

                $totalPerKecamatan += $jumlahPemilih;
            }

            $jumlahTotalPerKecamatan[$kecamatan] = $totalPerKecamatan;
        }

        return view('dcak.total-suara.index', [
            'jumlahPemilihPerKelurahanPerkecamatan' => $jumlahPemilihPerKelurahanPerkecamatan,
            'jumlahTotalPerKecamatan' => $jumlahTotalPerKecamatan
        ]);
    }

    function tableKoordinator()
    {
        // Membuat subquery untuk menghitung jumlah pemilih
        $subQuery = Pemilih::selectRaw('nama_koordinator, COUNT(*) as jumlah_pemilih')
            ->groupBy('nama_koordinator');

        // Query utama dengan join ke subquery
        $koordinator = Koordinator::leftJoinSub($subQuery, 'pemilih_count', function ($join) {
            $join->on('koordinator.nama_koordinator', '=', 'pemilih_count.nama_koordinator');
        })
            ->select([
                'koordinator.id_koordinator',
                'koordinator.username',
                'koordinator.password',
                'koordinator.nama_koordinator',
                'koordinator.jumlah_surat_dukungan',
                'koordinator.kelurahan',
                'koordinator.kecamatan',
                DB::raw('coalesce(pemilih_count.jumlah_pemilih, 0) as jumlah_pemilih') // Menetapkan default 0 jika tidak ada pemilih
            ]);

        return DataTables::of($koordinator)->make(true);
    }

    function inputKoordinator(Request $request)
    {
        $kelurahan = Kelurahan::all();
        $kecamatan = Kecamatan::all();
        return view('dcak.koordinator.input', compact('kelurahan', 'kecamatan'));
    }

    function formInputKoordinator(Request $request)
    {
        // dd($request->all());
        $koordinator = new Koordinator();
        $koordinator->nama_koordinator = $request->nama_koordinator;
        $koordinator->username = $request->username;
        $koordinator->password = $request->password;
        $koordinator->jumlah_surat_dukungan = $request->jumlah_surat_dukungan;
        $koordinator->kelurahan = $request->kelurahan;
        $koordinator->kecamatan = $request->kecamatan;
        $koordinator->save();


        return redirect()->route('koordinator')->with('success', 'Data koordinator berhasil disimpan.');
    }

    function editKoordinator($id)
    {
        $koordinator = Koordinator::find($id);
        return response()->json($koordinator);
    }

    function formEditKoordinator(Request $request, $id)
    {
        $koordinator = Koordinator::find($id);
        $koordinator->nama_koordinator = $request->nama_koordinator;
        $koordinator->username = $request->username;
        $koordinator->password = $request->password;
        $koordinator->jumlah_surat_dukungan = $request->jumlah_surat_dukungan;
        $koordinator->kelurahan = $request->kelurahan;
        $koordinator->kecamatan = $request->kecamatan;
        $koordinator->save();

        return redirect()->route('koordinator')->with('success', 'Data koordinator berhasil diupdate.');
    }

    function deleteKoordinator($id)
    {
        $koordinator = Koordinator::find($id);
        if ($koordinator) {
            $koordinator->delete();
            return response()->json(['success' => true, 'message' => 'Data koordinator berhasil dihapus.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Data koordinator tidak ditemukan.']);
        }
    }

    // Detail Koordinator
    public function detailKoordinator(Request $request, $id)
    {
        // Fetch the Koordinator by ID
        $koordinator = Koordinator::find($id);

        if (!$koordinator) {
            // Handle the case when Koordinator with the provided ID is not found
            abort(404, 'Koordinator not found');
        }

        $pemilihRecords = Pemilih::where('nama_koordinator', $koordinator->nama_koordinator)->get();


        // Pass both $koordinator and $pemilihRecords to the view
        return view('dcak.koordinator.detail', compact('koordinator', 'pemilihRecords'));
    }

    public function eksporPdfKoordinator($id)
    {
        $koordinator = Koordinator::find($id);
        $pemilihRecords = Pemilih::where('nama_koordinator', $koordinator->nama_koordinator)->get();

        $pdf = PDF::loadView('dcak.koordinator.pdf', compact('koordinator', 'pemilihRecords'));
        return $pdf->download('nama_file.pdf');
    }

    // Function Linjur
    function linjur(Request $request)
    {
        return view('dcak.linjur.index');
    }

    function tableLinjur()
    {
        $Pemilih = collect([]);


        if (Auth::check()) {
            $user = Auth::user();

            // If superadmin, display all data
            if ($user->level == 'superadmin') {
                $Pemilih = Pemilih::select(['id_pemilih', 'nama_koordinator', 'nik', 'nama_pemilih', 'jenis_kelamin', 'no_hp', 'rt', 'rw', 'tps', 'kelurahan']);
            }
            // If admin and has koordinator, display data based on nama_koordinator and kelurahan
            elseif ($user->level == 'admin' && $user->koordinator) {


                $Pemilih = Pemilih::where('nama_koordinator', $user->koordinator->nama_koordinator)
                    ->where('kelurahan', $user->koordinator->kelurahan)
                    ->select(['id_pemilih', 'id_calon_pemilih', 'nama_koordinator', 'nik', 'nama_pemilih', 'jenis_kelamin', 'no_hp', 'rt', 'rw', 'tps', 'kelurahan']);
            }
        }

        return DataTables::of($Pemilih)->make(true);
    }

    function inputLinjur(Request $request)
    {
        $kelurahan = Kelurahan::all();
        $koordinator = Koordinator::all();

        $user = Auth::user();
        $nama_koordinator = $user->koordinator->nama_koordinator;

        return view('dcak.linjur.input', compact('kelurahan', 'koordinator', 'nama_koordinator'));
    }

    public function getLinjurDetail(Request $request)
    {
        $nama = $request->input('nama');
        $kelurahan = $request->input('kelurahan');
        $rt = $request->input('rt');
        $rw = $request->input('rw');
        $tps = $request->input('tps');

        $pemilih = CalonPemilih::where('nama_pemilih', $nama)
            ->where('kelurahan', $kelurahan)
            ->where('rt', $rt)
            ->where('rw', $rw)
            ->where('tps', $tps)
            ->first();

        // Jika pemilih ditemukan, kirim data kembali sebagai respons
        if ($pemilih) {
            return response()->json([
                'jenis_kelamin' => $pemilih->jenis_kelamin,
                'no_hp' => $pemilih->no_hp,
                'rt' => $pemilih->rt,
                'rw' => $pemilih->rw,
                'tps' => $pemilih->tps,
                'kelurahan' => $pemilih->kelurahan,
                'id_calon_pemilih' => $pemilih->id_calon_pemilih,
                'nik' => $pemilih->nik
            ]);
        } else {
            // Jika tidak ditemukan, kirim respons gagal
            return response()->json(['error' => 'Pemilih tidak ditemukan'], 404);
        }
    }


    public function searchNamaLinjur(Request $request)
    {
        $query = $request->get('query');
        $kelurahan = $request->get('kelurahan'); // Dapatkan kelurahan dari request
        $excludedIds = $request->get('excludedIds', []); // Pastikan ini selalu diinisialisasi

        // Dapatkan semua id_calon_pemilih yang sudah ada di table pemilih
        $existingIds = Pemilih::pluck('id_calon_pemilih')->filter()->toArray();

        // Menggabungkan existingIds dan excludedIds untuk pembatasan
        $idsToExclude = array_merge($existingIds, $excludedIds);

        $results = CalonPemilih::where('nama_pemilih', 'LIKE', "%{$query}%")
            ->when($kelurahan, function ($query) use ($kelurahan) {
                // Jika kelurahan disediakan, tambahkan filter kelurahan ke query
                return $query->where('kelurahan', $kelurahan);
            })
            ->when(!empty($idsToExclude), function ($query) use ($idsToExclude) {
                // Hanya menerapkan whereNotIn jika ada ID untuk dikecualikan
                return $query->whereNotIn('id_calon_pemilih', $idsToExclude);
            })
            ->get();

        $output = '<div class="list-group">';

        if ($results->isEmpty()) {
            $output .= '<div class="list-group-item text-center">Tidak ada data pemilih</div>';
        } else {
            foreach ($results as $result) {
                $output .= '<a href="#" class="list-group-item list-group-item-action">' .
                    $result->nama_pemilih .
                    ' - RT: ' . $result->rt .
                    ' - RW: ' . $result->rw .
                    ' - TPS: ' . $result->tps .
                    ' - Kelurahan: ' . $result->kelurahan .
                    '</a>';
            }
        }

        $output .= '</div>';

        return $output;
    }

    public function getAllDataByKelurahan(Request $request)
    {
        $kelurahan = $request->get('kelurahan');
        $status = "terpilih";

        $data = CalonPemilih::where('kelurahan', $kelurahan)
            ->where(function ($query) use ($status) {
                $query->where('status', '!=', $status)
                    ->orWhereNull('status');
            })
            ->get();

        return response()->json($data);
    }






    // Function Pemilih

    function pemilih(Request $request)
    {
        return view('dcak.pemilih.index');
    }

    function tablePemilih()
    {
        $Pemilih = collect([]);


        if (Auth::check()) {
            $user = Auth::user();

            // If superadmin, display all data
            if ($user->level == 'superadmin') {
                $Pemilih = Pemilih::select(['id_pemilih', 'nama_koordinator', 'nik', 'nama_pemilih', 'jenis_kelamin', 'no_hp', 'rt', 'rw', 'tps', 'kelurahan']);
            }
            // If admin and has koordinator, display data based on nama_koordinator and kelurahan
            elseif ($user->level == 'admin' && $user->koordinator) {
                // dd($user->koordinator);

                // dd($user->koordinator->kelurahan, $user->koordinator->nama_koordinator);

                $Pemilih = Pemilih::where('nama_koordinator', $user->koordinator->nama_koordinator)
                    // ->where('kelurahan', $user->koordinator->kelurahan)
                    ->where('nama_koordinator', $user->koordinator->nama_koordinator)
                    ->select(['id_pemilih', 'id_calon_pemilih', 'nama_koordinator', 'nik', 'nama_pemilih', 'jenis_kelamin', 'no_hp', 'rt', 'rw', 'tps', 'kelurahan']);

                // dd($Pemilih);
            }
        }

        return DataTables::of($Pemilih)->make(true);
    }

    function inputPemilih(Request $request)
    {
        $kelurahan = Kelurahan::all();
        $koordinator = Koordinator::all();

        $user = Auth::user();
        $nama_koordinator = $user->koordinator->nama_koordinator;


        return view('dcak.pemilih.input', compact('kelurahan', 'koordinator', 'nama_koordinator'));
    }

    function inputPemilihNama(Request $request)
    {
        $kelurahan = Kelurahan::all();
        $koordinator = Koordinator::all();

        $user = Auth::user();
        $nama_koordinator = $user->koordinator->nama_koordinator;


        return view('dcak.pemilih.input-pemilih-nama', compact('kelurahan', 'koordinator', 'nama_koordinator'));
    }


    public function searchNama(Request $request)
    {
        $query = $request->get('query');

        // Mendapatkan informasi pengguna aktif
        $user = Auth::user();
        $nama_koordinator = $user->koordinator->kelurahan;

        // Dapatkan semua id_calon_pemilih yang sudah ada di table pemilih
        $existingIds = Pemilih::pluck('id_calon_pemilih')->filter()->toArray();

        $results = CalonPemilih::where('nama_pemilih', 'LIKE', "%{$query}%")
            ->where(function ($query) use ($existingIds) {
                if (!empty($existingIds)) {
                    $query->whereNotIn('id_calon_pemilih', $existingIds);
                }
            })
            ->where('kelurahan', $nama_koordinator)
            ->get();

        $output = '<div class="list-group">';

        if ($results->isEmpty()) {
            $output .= '<div class="list-group-item text-center">Tidak ada data pemilih</div>';
        } else {
            foreach ($results as $result) {
                $output .= '<a href="#" class="list-group-item list-group-item-action">' . $result->nama_pemilih . '</a>';
            }
        }

        $output .= '</div>';

        return $output;
    }


    public function getPemilihDetail(Request $request)
    {
        $nama = $request->get('nama');

        $pemilih = CalonPemilih::where('nama_pemilih', $nama)->first();

        if ($pemilih) {
            return response()->json($pemilih);
        } else {
            return response()->json(['error' => 'Pemilih tidak ditemukan'], 404);
        }
    }


    public function formInputPencarianPemilih(Request $request)
    {
        $Pemilih = new Pemilih();
        $Pemilih->id_calon_pemilih = $request->id_calon_pemilih;
        $Pemilih->nik = $request->nik;
        $Pemilih->nama_koordinator = $request->nama_koordinator;
        $Pemilih->nama_pemilih = $request->nama_pemilih;
        $Pemilih->jenis_kelamin = $request->jenis_kelamin;
        $Pemilih->no_hp = $request->no_hp;
        $Pemilih->rt = $request->rt;
        $Pemilih->rw = $request->rw;
        $Pemilih->tps = $request->tps;
        $Pemilih->kelurahan = $request->kelurahan;
        $Pemilih->save();

        return redirect()->route('pemilih')->with('success', 'Data Calon berhasil disimpan.');
    }

    public function formInputPencarianLinjur(Request $request)
    {
        try {

            $Pemilih = new Pemilih();
            $Pemilih->id_calon_pemilih = $request->id_calon_pemilih;
            $Pemilih->nik = $request->nik;
            $Pemilih->nama_koordinator = $request->nama_koordinator;
            $Pemilih->nama_pemilih = $request->nama_pemilih;
            $Pemilih->jenis_kelamin = $request->jenis_kelamin;
            $Pemilih->no_hp = $request->no_hp;
            $Pemilih->rt = $request->rt;
            $Pemilih->rw = $request->rw;
            $Pemilih->tps = $request->tps;
            $Pemilih->kelurahan = $request->kelurahan;
            $Pemilih->save();

            // UPDATE CALON PEMILIH
            $calonPemilih = CalonPemilih::find($request->id_calon_pemilih);
            if ($calonPemilih) {
                // statusnya
                $calonPemilih->status = 'terpilih';
                $calonPemilih->save();
            }

            return redirect()->route('linjur')->with('success', 'Data Calon berhasil disimpan.');
        } catch (\Exception $e) {
            // Log the error
            Log::error($e->getMessage());

            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }


    function formInputPemilih(Request $request)
    {
        // 1. Cek apakah nik atau nama_pemilih sudah ada di database
        $existingPemilihByNIK = Pemilih::where('nik', $request->nik)->first();
        $existingPemilihByName = Pemilih::where('nama_pemilih', $request->nama_pemilih)->first();
        $existingPemilihByRT = Pemilih::where('rt', $request->rt)->first();
        $existingPemilihByRW = Pemilih::where('rw', $request->rw)->first();
        $existingPemilihByKelurahan = Pemilih::where('kelurahan', $request->kelurahan)->first();

        if ($existingPemilihByNIK || $existingPemilihByName || $existingPemilihByRT || $existingPemilihByRW || $existingPemilihByKelurahan) {
            // Jika nik atau nama_pemilih sudah ada, kembali ke formulir dengan pesan kesalahan
            return back()->with('error', 'Data pemilih dengan NIK atau nama yang sama sudah ada.');
        }

        $Pemilih = new Pemilih();
        $Pemilih->nik = $request->nik;
        $Pemilih->nama_koordinator = $request->nama_koordinator;
        $Pemilih->nama_pemilih = $request->nama_pemilih;
        $Pemilih->jenis_kelamin = $request->jenis_kelamin;
        $Pemilih->no_hp = $request->no_hp;
        $Pemilih->rt = $request->rt;
        $Pemilih->rw = $request->rw;
        $Pemilih->tps = $request->tps;
        $Pemilih->kelurahan = $request->kelurahan;

        $Pemilih->save();

        return redirect()->route('pemilih')->with('success', 'Data pemilih berhasil disimpan.');
    }


    function editPemilih($id)
    {
        $Pemilih = Pemilih::find($id);
        return response()->json($Pemilih);
    }

    function formEditPemilih(Request $request, $id)
    {
        $Pemilih = Pemilih::find($id);
        $Pemilih->nik = $request->nik;
        $Pemilih->nama_koordinator = $request->nama_koordinator;
        $Pemilih->nama_pemilih = $request->nama_pemilih;
        $Pemilih->jenis_kelamin = $request->jenis_kelamin;
        $Pemilih->no_hp = $request->no_hp;
        $Pemilih->rt = $request->rt;
        $Pemilih->rw = $request->rw;
        $Pemilih->tps = $request->tps;
        $Pemilih->kelurahan = $request->kelurahan;
        $Pemilih->save();

        return redirect()->route('pemilih')->with('success', 'Data pemilih berhasil diupdate.');
    }

    public function deletePemilih($idPemilih, $idCalonPemilih)
    {
        // Temukan CalonPemilih dengan id_calon_pemilih yang sesuai
        $calonPemilih = CalonPemilih::find($idCalonPemilih);

        if ($calonPemilih) {
            // Set status pada CalonPemilih menjadi null
            $calonPemilih->status = null;
            $calonPemilih->save();
        }

        // Temukan Pemilih
        $pemilih = Pemilih::find($idPemilih);

        if (!$pemilih) {
            return response()->json(['success' => false, 'message' => 'Data pemilih tidak ditemukan.']);
        }

        // Hapus Pemilih
        $pemilih->delete();

        return response()->json(['success' => true, 'message' => 'Data pemilih berhasil dihapus.']);
    }



    function importExcelPemilih(Request $request)
    {

        $request->validate([
            'excel_file_pemilih' => 'required|mimes:xls,xlsx',
        ]);

        $file = $request->file('excel_file_pemilih');

        try {
            Excel::import(new PemilihImport(), $file);
            return redirect()->route('pemilih')->with('success', 'Data berhasil diimpor dari Excel.');
        } catch (\Exception $e) {
            return redirect()->route('pemilih')->with('error', 'Terjadi kesalahan saat mengimpor data dari Excel: ' . $e->getMessage());
        }
    }



    // Function Kelurahan
    function kelurahan(Request $request)
    {
        return view('dcak.kelurahan.index');
    }

    function tableKelurahan()
    {
        $kelurahan = Kelurahan::select(['id', 'nama_kelurahan']);
        return DataTables::of($kelurahan)->make(true);
    }

    // input kelurahan
    function inputKelurahan(Request $request)
    {
        return view('dcak.kelurahan.input');
    }

    function inputFormKelurahan(Request $request)
    {
        $kelurahan = new Kelurahan();
        $kelurahan->nama_kelurahan = strtoupper($request->nama_kelurahan);
        $kelurahan->save();

        return redirect()->route('kelurahan')->with('success', 'Data kelurahan berhasil disimpan.');
    }

    // Function Kecamatan
    function kecamatan(Request $request)
    {

        return view('dcak.kecamatan.index');
    }

    function tableKecamatan()
    {
        $kecamatan = Kecamatan::select(['id_kecamatan', 'nama_kecamatan']);
        return DataTables::of($kecamatan)->make(true);
    }

    function inputKecamatan(Request $request)
    {
        return view('dcak.kecamatan.input');
    }

    function inputFormKecamatan(Request $request)
    {
        $kecamatan = new Kecamatan();
        $kecamatan->nama_kecamatan = strtoupper($request->nama_kecamatan);
        $kecamatan->save();

        return redirect()->route('kecamatan')->with('success', 'Data kecamatan berhasil disimpan.');
    }

    /*
     * Dashboard Pages Routs
     */
    public function index(Request $request)
    {
        $assets = ['chart', 'animation'];


        // Hitung Koordinator
        $koordinator = Koordinator::all();
        $jumlahKoordinator = $koordinator->count();

        // Hitung Calon Pemilih
        $calonPemilih = CalonPemilih::all();
        $jumlahCalonPemilih = $calonPemilih->count();

        // Hitung Pemilih
        $pemilih = Pemilih::all();


        $jumlahPemilih = $pemilih->count();

        // Hitung Akun Dcak
        $akunDcak = User_dcak::all();
        $jumlahAkunDcak = $akunDcak->count();

        return view('dashboards.dashboard', compact('assets', 'jumlahKoordinator', 'jumlahCalonPemilih', 'jumlahPemilih', 'jumlahAkunDcak', 'pemilih'));
    }

    public function dataChart($periode)
    {

        // mendapatkan tanggal sekarang
        $tanggalSekarang = Carbon::today()->endOfDay();  // mendapatkan akhir dari hari ini (23:59:59)

        // menghitung tanggal awal berdasarkan periode dari tanggal sekarang
        $tanggalAwal = $tanggalSekarang->copy()->subDays($periode - 1)->startOfDay(); // mengambil awal dari hari tersebut (00:00:00) setelah dikurangi periode

        // mengambil data pemilih yang berada dalam periode tertentu dari tanggal saat ini, dengan relasi ke koordinator
        $chartData = Pemilih::with('koordinator')
            ->whereBetween('created_at', [$tanggalAwal, $tanggalSekarang])
            ->get();

        return response()->json($chartData);
    }


    /*
     * Menu Style Routs
     */
    public function horizontal(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.horizontal', compact('assets'));
    }
    public function dualhorizontal(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.dual-horizontal', compact('assets'));
    }
    public function dualcompact(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.dual-compact', compact('assets'));
    }
    public function boxed(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.boxed', compact('assets'));
    }
    public function boxedfancy(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.boxed-fancy', compact('assets'));
    }

    /*
     * Pages Routs
     */
    public function billing(Request $request)
    {
        return view('special-pages.billing');
    }

    public function calender(Request $request)
    {
        $assets = ['calender'];
        return view('special-pages.calender', compact('assets'));
    }

    public function kanban(Request $request)
    {
        return view('special-pages.kanban');
    }

    public function pricing(Request $request)
    {
        return view('special-pages.pricing');
    }

    public function rtlsupport(Request $request)
    {
        return view('special-pages.rtl-support');
    }

    public function timeline(Request $request)
    {
        return view('special-pages.timeline');
    }


    /*
     * Widget Routs
     */
    public function widgetbasic(Request $request)
    {
        return view('widget.widget-basic');
    }
    public function widgetchart(Request $request)
    {
        $assets = ['chart'];
        return view('widget.widget-chart', compact('assets'));
    }
    public function widgetcard(Request $request)
    {
        return view('widget.widget-card');
    }

    /*
     * Maps Routs
     */
    public function google(Request $request)
    {
        return view('maps.google');
    }
    public function vector(Request $request)
    {
        return view('maps.vector');
    }

    /*
     * Auth Routs
     */
    public function signin(Request $request)
    {
        return view('auth.login');
    }
    public function signup(Request $request)
    {
        return view('auth.register');
    }
    public function confirmmail(Request $request)
    {
        return view('auth.confirm-mail');
    }
    public function lockscreen(Request $request)
    {
        return view('auth.lockscreen');
    }
    public function recoverpw(Request $request)
    {
        return view('auth.recoverpw');
    }
    public function userprivacysetting(Request $request)
    {
        return view('auth.user-privacy-setting');
    }

    /*
     * Error Page Routs
     */

    public function error404(Request $request)
    {
        return view('errors.error404');
    }

    public function error500(Request $request)
    {
        return view('errors.error500');
    }
    public function maintenance(Request $request)
    {
        return view('errors.maintenance');
    }

    /*
     * uisheet Page Routs
     */
    public function uisheet(Request $request)
    {
        return view('uisheet');
    }

    /*
     * Form Page Routs
     */
    public function element(Request $request)
    {
        return view('forms.element');
    }

    public function wizard(Request $request)
    {
        return view('forms.wizard');
    }

    public function validation(Request $request)
    {
        return view('forms.validation');
    }

    /*
     * Table Page Routs
     */
    public function bootstraptable(Request $request)
    {
        return view('table.bootstraptable');
    }

    public function datatable(Request $request)
    {
        return view('table.datatable');
    }

    /*
     * Icons Page Routs
     */

    public function solid(Request $request)
    {
        return view('icons.solid');
    }

    public function outline(Request $request)
    {
        return view('icons.outline');
    }

    public function dualtone(Request $request)
    {
        return view('icons.dualtone');
    }

    public function colored(Request $request)
    {
        return view('icons.colored');
    }

    /*
     * Extra Page Routs
     */
    public function privacypolicy(Request $request)
    {
        return view('privacy-policy');
    }
    public function termsofuse(Request $request)
    {
        return view('terms-of-use');
    }
}
