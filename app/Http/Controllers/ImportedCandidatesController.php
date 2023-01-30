<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Imports\ImportCandidates;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Models\ImportedCandidates;

class ImportedCandidatesController extends HelperController {

    public function imported_candidates() {
        $data['candidates'] = ImportedCandidates::get_imported_candidates();

        return view('admin.imported-candidates')->with($data);
    }

    public function import_candidates(Request $request) {
        // Excel::import(new ImportCandidates, $request->file('file'));
        $rows = Excel::toArray(new ImportCandidates, $request->file('file'));
        // echo '<pre>';print_r($rows);exit;
        $i = 0;

        foreach ($rows[0] as $value) {
            if($value['email'] || $value['mobile']) {
                $candidates = ImportedCandidates::fetch_imported_candidates($value['email'], $value['mobile']);
            }
            
            // DB::enableQueryLog();
            // dd(DB::getQueryLog());
            if(!empty($candidates) || !$value['email'] || !$value['mobile']) {
                ImportedCandidates::create([
                    'full_name'     => ucwords(strtolower($value['full_name'])),
                    'designation'    => $value['designation'],
                    'last_company'    => $value['last_company'],
                    'education'    => $value['education'],
                    'location'    => $value['location'],
                    'mobile'    => $value['mobile'],
                    'email'    => strtolower($value['email']),
                    'experience'    => $value['experience'],
                    'gender'    => $value['gender'],
                    'age'    => $value['age'],
                    'salary'    => $value['salary'],
                    'source'    => $value['source'],
                    'remarks'    => $value['remarks'],
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                ++$i;
            }
        }

        return redirect()->back()->with('success', 'Data Uploaded');
    }

    public function delete_imported_candidates(Request $request) {
        if($request->select) {
            ImportedCandidates::delete_imported_candidates($request->select);
            
            return redirect('admin/imported-candidates')->with('success', 'Candidates Deleted');
        } else {
            return redirect('admin/imported-candidates')->with('error', 'No Candidates Selected');
        }  
    }

    public function edit_imported_candidate($id) {
        $data['department'] = $this->job_department();
        $data['position'] = $this->job_position();
        $data['candidate'] = ImportedCandidates::fetch_imported_candidate($id);

        return view('admin.edit-imported-candidate')->with($data);
    }

    public function update_imported_candidate($id, Request $request) {
        $ImportedCandidates = new ImportedCandidates();
        $data = $request->only($ImportedCandidates->getFillable());
        
        ImportedCandidates::update_imported_candidate($id, $data);

        return response()->json(['status' => 'success', 'message' => 'Candidate Details Updated']);
    }
}
