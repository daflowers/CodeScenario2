<?php

namespace App\Http\Controllers;

use App\Models\activity_log;
use App\Models\person_type;
use Illuminate\Http\Request;

class Manage2FAController extends Controller
{
    public function create()
    {
        $userName = session('username');
        $row = person_type::where('foreign_id', $userName)->first();

        return view('manage2FA.authentication', compact('row'));
    }

    public function store(Request $request) {
        $inputs = request()->validate([
            'twoFA' => 'required',
            'twoFA-other' => 'required_if:twoFA,Other'
        ]);

        $userName = session('username');
        $row = person_type::where('foreign_id', $userName)->first();

        if (!empty($row) && (($inputs['twoFA'] == 'Other' && ($row['person_type'] == $inputs['twoFA-other'])) || ($row['person_type'] == $inputs['twoFA']))) {
            return redirect()->route('2fa-setting');
        } else {
            $newPersonType = in_array($inputs['twoFA'], ['Dog', 'Cat']) ? $inputs['twoFA'] : $inputs['twoFA-other'];

            $logData = [
                'foreign_id' => $userName,
                'olddata' => $row->person_type ?? '',
                'newdata' => $newPersonType,
            ];

            activity_log::create($logData);

            $row->person_type = $newPersonType;
            $row->save();
        }

        return redirect()->route('2fa-setting');
    }
}
