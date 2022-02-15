<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return response()->json([
            'status' => 200,
            'contacts' => $contacts,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phoneNumber' => 'required|max:11|min:11',
            'address' => 'required',
            'companyName' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'validate_err' => $validator->messages(),
            ]);
        } else {
            $contact = new Contact;
            $contact->firstName = $request->input('firstName');
            $contact->lastName = $request->input('lastName');
            $contact->email = $request->input('email');
            $contact->phoneNumber = $request->input('phoneNumber');
            $contact->address = $request->input('address');
            $contact->companyName = $request->input('companyName');

            $contact->save();

            return response()->json([
                'status' => 200,
                'message' => 'Contact Added Successfully',
            ]);
        }
    }

    public function edit($id)
    {
        $contact = Contact::find($id);
        if ($contact) {
            return response()->json([
                'status' => 200,
                'contact' => $contact,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Contact Found',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phoneNumber' => 'required|max:11|min:11',
            'address' => 'required',
            'companyName' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'validationErrors' => $validator->messages(),
            ]);
        } else {
            $contact = Contact::find($id);
            if ($contact) {


                $contact->firstName = $request->input('firstName');
                $contact->lastName = $request->input('lastName');
                $contact->email = $request->input('email');
                $contact->phoneNumber = $request->input('phoneNumber');
                $contact->address = $request->input('address');
                $contact->companyName = $request->input('companyName');
                $contact->update();

                return response()->json([
                    'status' => 200,
                    'message' => 'Contact Updated Successfully',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No Contact Found',
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);
        if ($contact) {
            $contact->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Contact Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Contact Found',
            ]);
        }
    }
    public function ProductBySearch(Request $request)
    {

        $key = $request->key;
        $productlist = Contact::where('name', 'LIKE', "%{$key}%")
            ->orWhere('course', 'LIKE', "%{$key}%")->get();
        return $productlist;
    } // End Method
}
