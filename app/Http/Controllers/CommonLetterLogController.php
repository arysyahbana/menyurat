<?php

namespace App\Http\Controllers;

use App\Helpers\ConverterLetterLog;
use App\Http\Requests\StoreCommonLetterLogRequest;
use App\Http\Requests\StoreCommonLogSlugRequest;
use App\Http\Requests\UpdateCommonLetterLogRequest;
use App\Http\Requests\UpdateNumberOfLetterRequest;
use App\Models\CommonLetterLog;
use App\Models\LetterLog;
use Illuminate\Http\Request;
use stdClass;
use Barryvdh\DomPDF\Facade\Pdf;

class CommonLetterLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $letters = config("central.letter_types");

        if ($request->query("search") !== null) {
            $letters = array_filter($letters, function ($name) use ($request) {
                return str_contains(strtolower($name), strtolower($request->query("search")));
            }, ARRAY_FILTER_USE_KEY);
        }

        return view("user.kelola_surat.index", ["letters" => $letters]);
    }

    public function listIndex(Request $request, string $slug)
    {
        $splitSlug = explode("-", $slug);
        $letterType = implode(" ", $splitSlug);
        $existLetterType = false;

        // check letter type
        foreach (array_keys(config("central.letter_types")) as $key) {
            if (strtolower($letterType) === strtolower($key)) {
                $letterType = $key;
                $existLetterType = true;
                break;
            }
        }

        if (!$existLetterType) {
            return abort(404);
        }

        $commonLetterLogs = CommonLetterLog::where("type", $letterType)
            ->search($request->query("search"))
            ->published($request->query("published"))
            ->paginate(10)
            ->withQueryString();

        return view("user.kelola_surat.child_kelola_surat.index", ["title" => $letterType, "commonLogs" => $commonLetterLogs]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommonLetterLogRequest $request)
    {
        $validated = $request->validated();

        // check letter type
        if (!array_key_exists($validated["type"], config("central.letter_types"))) {
            return back()->with("error", "Surat gagal ditambahkan");
        }

        $commonLetterLog = CommonLetterLog::create([
            "user_id" => auth()->user()->id,
            "title" => $validated["title"],
            "type" => $validated["type"],
        ]);

        return redirect()->route("letter.log.create", ["commonLetterLog" => $commonLetterLog->id])->with("success", "Surat berhasil ditambahkan");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeSlug(StoreCommonLogSlugRequest $request, string $slug)
    {
        $validated = $request->validated();
        $splitSlug = explode("-", $slug);
        $letterType = implode(" ", $splitSlug);
        $existLetterType = false;

        // check letter type
        foreach (array_keys(config("central.letter_types")) as $key) {
            if (strtolower($letterType) === strtolower($key)) {
                $letterType = $key;
                $existLetterType = true;
                break;
            }
        }

        if (!$existLetterType) {
            return back()->with("error", "Surat tidak tersedia");
        }

        $commonLetterLog = CommonLetterLog::create([
            "user_id" => auth()->user()->id,
            "title" => $validated["title"],
            "type" => $letterType,
        ]);

        return redirect()->route("letter.log.create", ["commonLetterLog" => $commonLetterLog->id])->with("success", "Surat berhasil ditambahkan");
    }

    public function update(UpdateNumberOfLetterRequest $request, CommonLetterLog $commonLetterLog)
    {
        $validated = $request->validated();

        CommonLetterLog::where("id", $commonLetterLog->id)
            ->update([
                "number_of_letter" => $validated["number_of_letter"],
            ]);

        return back()->with("success", "Surat berhasil diterbitkan");
    }

    /**
     * Update the specified resource in storage.
     */
    public function APIUpdate(UpdateCommonLetterLogRequest $request, CommonLetterLog $commonLetterLog)
    {
        $validated = $request->validated();

        CommonLetterLog::where("id", $commonLetterLog->id)
            ->update([
                "title" => $validated["title"],
            ]);

        // response fetch api
        $response = new stdClass;
        $response->status = 'success';
        $response->message = 'Judul surat berhasil diperbarui';
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommonLetterLog $commonLetterLog)
    {
        $commonLetterLog->delete();

        return back()->with("success", "Surat berhasil dihapus");
    }

    protected function getLetterLog(CommonLetterLog $commonLetterLog)
    {
        $letterLogs = LetterLog::where("common_letter_log_id", $commonLetterLog->id)->get();
        $logs = ConverterLetterLog::getLetterLog($commonLetterLog, $letterLogs->toArray());
        /**
         * TODO View: kode dibawah ini untuk lihat bentuk datanya
         * kalau mau lihat halamannya, comment saja kode baris 21
         */
        // dd($logs);
        return $logs;
    }

    public function download(CommonLetterLog $commonLetterLog)
    {
        $logs = $this->getLetterLog($commonLetterLog);

        $view = config(sprintf("central.letter_types.%s.pdf", $commonLetterLog->type));
        $pdf = Pdf::loadView($view, [
            "user" => auth()->user(),
            "commonLog" => $commonLetterLog,
            "logs" => $logs
        ]);
        $pdf->setPaper("A4", "portrait");
        return $pdf->download(sprintf("%s - %s.pdf", $commonLetterLog->title, $commonLetterLog->type));
    }

    public function preview(CommonLetterLog $commonLetterLog)
    {
        $logs = $this->getLetterLog($commonLetterLog);

        $view = config(sprintf("central.letter_types.%s.pdf", $commonLetterLog->type));
        $pdf = Pdf::loadView($view, [
            "user" => auth()->user(),
            "commonLog" => $commonLetterLog,
            "logs" => $logs
        ]);
        $pdf->setPaper("A4", "portrait");
        return $pdf->stream(sprintf("%s - %s.pdf", $commonLetterLog->title, $commonLetterLog->type));
    }
}
