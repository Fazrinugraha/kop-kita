<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Dokumentasi;
use App\Models\DokumentasiFoto;
use App\Models\DokumentasiVideo;
use Illuminate\Support\Facades\DB;

class DokumentasiController extends Controller
{
    public function index(Request $request)
    {
        $tipe = $request->query('tipe');

        $query = Dokumentasi::with(['foto', 'video'])->orderBy('id', 'DESC');

        if ($tipe === 'foto') {
            $query->whereHas('foto')->whereDoesntHave('video');
        } elseif ($tipe === 'video') {
            $query->whereHas('video');
        }

        $dataview = new \stdClass();
        $dataview->title = 'Dokumentasi | ' . getTitle();
        $dataview->page_title = 'Dokumentasi';
        $dataview->data_admin = Auth::guard('admin')->user();
        $dataview->dokumentasi = $query->get();

        return view('pages.admin.dokumentasi', compact('dataview'));
    }



    public function store(Request $request)
    {
        $tipe = $request->input('tipe_media');

        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date|before_or_equal:today',
            'deskripsi' => 'nullable|string',
            'tipe_media' => 'required|in:foto,video',
            'video_source' => $tipe === 'video' ? 'required|in:local,youtube' : 'nullable',
            'media_file.*' => $tipe === 'foto'
                ? 'required|file|mimes:jpg,jpeg,png|max:10240'
                : 'nullable|file|mimes:mp4|max:10240',
            'video_youtube' => $tipe === 'video' && $request->video_source === 'youtube'
                ? ['required', 'regex:/^(https?\:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+$/']
                : 'nullable'
        ]);

        DB::beginTransaction();

        try {
            $dokumentasi = Dokumentasi::create([
                'judul' => $request->judul,
                'tanggal' => $request->tanggal,
                'deskripsi' => $request->deskripsi,
            ]);

            if ($tipe === 'foto' && $request->hasFile('media_file')) {
                foreach ($request->file('media_file') as $file) {
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = 'storage/dokumentasi';
                    $file->move(public_path($path), $filename);

                    DokumentasiFoto::create([
                        'dokumentasi_id' => $dokumentasi->id,
                        'file_path' => $path . '/' . $filename,
                    ]);
                }
            }

            if ($tipe === 'video') {
                if ($request->video_source === 'local' && $request->hasFile('media_file')) {
                    foreach ($request->file('media_file') as $file) {
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $path = 'storage/dokumentasi';
                        $file->move(public_path($path), $filename);

                        DokumentasiVideo::create([
                            'dokumentasi_id' => $dokumentasi->id,
                            'tipe' => 'local',
                            'media_path' => $path . '/' . $filename,
                            'is_preview' => 'Y',
                        ]);
                    }
                }

                if ($request->video_source === 'youtube') {
                    DokumentasiVideo::create([
                        'dokumentasi_id' => $dokumentasi->id,
                        'tipe' => 'youtube',
                        'media_path' => $request->video_youtube,
                        'is_preview' => 'Y',
                    ]);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Dokumentasi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menyimpan dokumentasi: ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        $dokumentasi = Dokumentasi::findOrFail($id);
        $tipe = $request->input('tipe_media');

        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date|before_or_equal:today',
            'deskripsi' => 'nullable|string',
            'tipe_media' => 'required|in:foto,video',
            'video_source' => $tipe === 'video' ? 'required|in:local,youtube' : 'nullable',
            'media_file.*' => $tipe === 'foto'
                ? 'nullable|file|mimes:jpg,jpeg,png|max:10240'
                : 'nullable|file|mimes:mp4|max:10240',
            'video_youtube' => $tipe === 'video' && $request->video_source === 'youtube'
                ? ['required', 'regex:/^(https?\:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+$/']
                : 'nullable'
        ]);

        DB::beginTransaction();

        try {
            $dokumentasi->update([
                'judul' => $request->judul,
                'tanggal' => $request->tanggal,
                'deskripsi' => $request->deskripsi,
            ]);

            if ($tipe === 'foto' && $request->hasFile('media_file')) {
                foreach ($request->file('media_file') as $file) {
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = 'storage/dokumentasi';
                    $file->move(public_path($path), $filename);

                    DokumentasiFoto::create([
                        'dokumentasi_id' => $dokumentasi->id,
                        'file_path' => $path . '/' . $filename,
                    ]);
                }
            }

            if ($tipe === 'video') {
                // Remove deletion of all old videos to keep existing ones

                // Add new uploaded local videos if any
                if ($request->video_source === 'local' && $request->hasFile('media_file')) {
                    foreach ($request->file('media_file') as $file) {
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $path = 'storage/dokumentasi';
                        $file->move(public_path($path), $filename);

                        DokumentasiVideo::create([
                            'dokumentasi_id' => $dokumentasi->id,
                            'tipe' => 'local',
                            'media_path' => $path . '/' . $filename,
                            'is_preview' => 'Y',
                        ]);
                    }
                }

                // Add new YouTube video if provided
                if ($request->video_source === 'youtube' && $request->video_youtube) {
                    DokumentasiVideo::create([
                        'dokumentasi_id' => $dokumentasi->id,
                        'tipe' => 'youtube',
                        'media_path' => $request->video_youtube,
                        'is_preview' => 'Y',
                    ]);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Dokumentasi berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal memperbarui dokumentasi: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        $dokumentasi = Dokumentasi::with(['foto', 'video'])->findOrFail($id);

        foreach ($dokumentasi->foto as $foto) {
            $path = public_path($foto->file_path);
            if (File::exists($path)) {
                File::delete($path);
            }
            $foto->delete();
        }

        foreach ($dokumentasi->video as $video) {
            if ($video->tipe === 'local') {
                $path = public_path($video->media_path);
                if (File::exists($path)) {
                    File::delete($path);
                }
            }
            $video->delete();
        }

        $dokumentasi->delete();

        return redirect()->back()->with('success', 'Dokumentasi berhasil dihapus.');
    }

    public function destroyFoto($id)
    {
        $foto = DokumentasiFoto::findOrFail($id);
        if (File::exists(public_path($foto->file_path))) {
            File::delete(public_path($foto->file_path));
        }
        $foto->delete();

        return redirect()->back()->with('success', 'Foto berhasil dihapus.');
    }

    public function destroyVideo($id)
    {
        $video = DokumentasiVideo::findOrFail($id);
        if ($video->tipe === 'local' && File::exists(public_path($video->media_path))) {
            File::delete(public_path($video->media_path));
        }
        $video->delete();

        return redirect()->back()->with('success', 'Video berhasil dihapus.');
    }

    public function destroyMedia($id)
    {
        $foto = DokumentasiFoto::findOrFail($id);

        if (file_exists(public_path($foto->file_path))) {
            unlink(public_path($foto->file_path));
        }

        $foto->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
