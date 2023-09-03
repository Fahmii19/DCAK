<?php

namespace App\Http\Controllers;

// import model CalonPemilih
use App\Models\CalonPemilih;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CalonPemilihImport;
use App\Models\Pemilih;
use App\Models\Koordinator;
use App\Models\Kelurahan;
use App\Models\Kecamatan;


use Illuminate\Http\Request;

class HomeController extends Controller
{
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
        $Pemilih = Pemilih::select(['id_pemilih', 'nama_koordinator', 'nama_koordinator', 'nama_pemilih', 'jenis_kelamin', 'no_hp', 'rt', 'rw', 'tps', 'kelurahan']);
        return DataTables::of($Pemilih)->make(true);
    }

    function inputPemilih(Request $request)
    {
        $kelurahan = Kelurahan::all();
        $koordinator = Koordinator::all();

        return view('dcak.pemilih.input', compact('kelurahan', 'koordinator'));
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
