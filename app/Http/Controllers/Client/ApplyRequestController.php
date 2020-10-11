<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ApplyRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ApplyRequestController extends Controller
{
  public function accept(Request $request, ApplyRequest $applyRequest)
  {
    $modelsRequest = $applyRequest->request;
    $data = $applyRequest->toArray();
    $data['company_id'] = $modelsRequest->company->id;
    $data['finance_type'] = $modelsRequest->finance_type;
    $data['fee'] = $modelsRequest->fee;
    $data['description'] = $modelsRequest->description;
    Project::MakeProject($data);
    $applyRequest->request->delete();
    $applyRequest->delete();
    return redirect(route('client.project.index'));
  }

  public function reject(Request $request, ApplyRequest $applyRequest)
  {
    $applyRequest->delete();
    return redirect(route('client.request.index'));
  }
}
