<?php

namespace App\Http\Controllers;

// import model CalonPemilih
use App\Models\CalonPemilih;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CalonPemilihImport;
use App\Models\Pemilih;
use App\Models\User_dcak;
use App\Models\Koordinator;
use App\Models\Kelurahan;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\Auth;

// middleware
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;


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


    // Landing Page
    public function landingPage(Request $request)
    {
        return view('landing-page.home');
    }

    // Calon Pemilih
    public function calonPemilih(Request $request)
    {
        return view('dcak.calon-pemilih.index');
    }

    public function tableCalonPemilih()
    {
        $calonPemilih = CalonPemilih::select(['id_pemilih', 'nama_pemilih', 'jenis_kelamin', 'no_hp', 'rt', 'rw', 'tps', 'kelurahan']);
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

    // Function Koordinator
    function koordinator(Request $request)
    {
        return view('dcak.koordinator.index');
    }

    function tableKoordinator()
    {
        $koordinator = Koordinator::select(['id_koordinator', 'username', 'password', 'nama_koordinator', 'jumlah_surat_dukungan', 'kelurahan', 'kecamatan']);
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

    // Function Pemilih

    function pemilih(Request $request)
    {
        return view('dcak.pemilih.index');
    }

    function tablePemilih()
    {
        if (Auth::check()) {
            // If superadmin, display all data
            if (Auth::user()->level == 'superadmin') {
                $Pemilih = Pemilih::select(['id_pemilih', 'nama_koordinator', 'nama_koordinator', 'nama_pemilih', 'jenis_kelamin', 'no_hp', 'rt', 'rw', 'tps', 'kelurahan']);
            }
            // If admin, display data based on nama_koordinator and kelurahan
            elseif (Auth::user()->level == 'admin') {
                $userKelurahan = Auth::user()->koordinator->kelurahan;
                $Pemilih = Pemilih::where('nama_koordinator', Auth::user()->koordinator->nama_koordinator)
                    ->where('kelurahan', $userKelurahan)
                    ->select(['id_pemilih', 'nama_koordinator', 'nama_koordinator', 'nama_pemilih', 'jenis_kelamin', 'no_hp', 'rt', 'rw', 'tps', 'kelurahan']);
            }
        } else {
            // If user is not authenticated, you can either return an empty result or redirect them to a login page.
            // For this example, I'll return an empty result.
            $Pemilih = collect([]);
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

        // $calonPemilih = CalonPemilih::get();

        $user = Auth::user();
        $nama_koordinator = $user->koordinator->nama_koordinator;


        return view('dcak.pemilih.input-pemilih-nama', compact('kelurahan', 'koordinator', 'nama_koordinator'));
    }

    public function searchNama(Request $request)
    {
        $query = $request->get('query');

        $results = CalonPemilih::where('nama_pemilih', 'LIKE', "%{$query}%")->get();

        $output = '<div class="list-group">';

        foreach ($results as $result) {
            $output .= '<a href="#" class="list-group-item list-group-item-action">' . $result->nama_pemilih . '</a>';
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


    function formInputPemilih(Request $request)
    {
        $Pemilih = new Pemilih();
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
        $kelurahan->nama_kelurahan = $request->nama_kelurahan;
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
        $kecamatan->nama_kecamatan = $request->nama_kecamatan;
        $kecamatan->save();

        return redirect()->route('kecamatan')->with('success', 'Data kecamatan berhasil disimpan.');
    }

    /*
     * Dashboard Pages Routs
     */
    public function index(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('dashboards.dashboard', compact('assets'));
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
