<?php

namespace App\Http\Controllers;

use App\Helpers\ConverterLetterLog;
use App\Http\Requests\StoreLetterLogRequest;
use App\Models\CommonLetterLog;
use App\Models\LetterLog;

class LetterLogController extends Controller
{
    public function create(CommonLetterLog $commonLetterLog)
    {
        $letterLogs = LetterLog::where("common_letter_log_id", $commonLetterLog->id)->get();
        $logs = ConverterLetterLog::getLetterLog($commonLetterLog, $letterLogs->toArray());
        /**
         * TODO View: kode dibawah ini untuk lihat bentuk datanya
         * kalau mau lihat halamannya, comment saja kode baris 21
         */
        // dd($logs);

        $view = config(sprintf("central.letter_types.%s.view", $commonLetterLog->type));
        return view($view, [
            "user" => auth()->user()->load("urbanVillage", "district", "region", "province"),
            "commonLog" => $commonLetterLog,
            "logs" => $logs
        ]);
    }

    public function store(StoreLetterLogRequest $request, CommonLetterLog $commonLetterLog)
    {
        // dd($request->all());
        // die;
        $validated = $request->validated();
        $data = ConverterLetterLog::setLetterLog($commonLetterLog, $validated);
        foreach ($data as $key => $value) {
            LetterLog::where("common_letter_log_id", $commonLetterLog->id)
                ->where("field_name", $value["field_name"])
                ->update($value);
        }

        return redirect()->route("dashboard")->with("success", "Data surat berhasil disimpan");
    }
}
