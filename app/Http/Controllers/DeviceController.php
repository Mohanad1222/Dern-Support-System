<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function updateDeviceStatus(Request $request, $device){
        $device = Device::where('request_id', $device);
        $device->update([
            'device_status' => $request->device_status
        ]);

        return redirect()->back();
    }
}
