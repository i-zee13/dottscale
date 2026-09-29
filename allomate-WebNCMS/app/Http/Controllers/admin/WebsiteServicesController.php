<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class WebsiteServicesController extends Controller
{
    public function index()
    {
        return view('admin.website-services');
    }

    public function list()
    {
        $services = Schema::hasTable('services')
            ? Service::orderBy('sort_order')->orderBy('id')->get()
            : collect();

        return response()->json([
            'status' => 'success',
            'services' => $services,
        ]);
    }

    public function get($id)
    {
        $service = Service::find($id);

        return response()->json([
            'status' => 'success',
            'service' => $service,
        ]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'service_name' => 'required',
        ]);

        $name = trim($request->service_name);
        $id = $request->hidden_service_id;

        $dup = Service::where('service_name', $name)
            ->when($id, fn ($q) => $q->where('id', '!=', $id))
            ->exists();
        if ($dup) {
            return response()->json(['status' => 'error', 'msg' => 'duplicate']);
        }

        $service = $id ? Service::find($id) : new Service();
        if (!$service) {
            $service = new Service();
        }

        $service->service_name = $name;
        $service->slug = $request->slug ?: Str::slug($name);
        $service->description = $request->description;
        $service->route = $request->route;
        $service->sort_order = (int) ($request->sort_order ?: 0);
        $service->status = (int) $request->status;

        if ($request->hasFile('icon_file')) {
            $service->icon = '/storage/' . $request->file('icon_file')->store('services', 'public');
        } elseif ($request->filled('icon')) {
            $service->icon = $request->icon;
        } elseif ($request->filled('hidden_icon')) {
            $service->icon = $request->hidden_icon;
        }

        if (!$service->created_by) {
            $service->created_by = Auth::user()->id;
        }
        $service->updated_by = Auth::user()->id;
        $service->save();

        return response()->json(['status' => 'success', 'msg' => 'Added']);
    }

    public function delete($id)
    {
        Service::destroy($id);

        return response()->json([
            'status' => 'success',
            'msg' => 'Deleted',
        ]);
    }
}
