<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use Dotenv\Dotenv;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    private $db;
    private $table;
    private $field;
    private $condition;

    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;
    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request)
    {

        $this->connect(getenv('DB_DATABASE'));
    }


    public function select()
    {

        $result = $this->database->select('product', '*');

        return $this->handlers($result);
    }

    public function filter($id)
    {

        $result = $this->database->select('product', '*', ['id' => $id]);

        return $this->handlers($result);
    }


    public function create(Request $request)
    {

        $validator =  Validator::make($request->all(), [
            'description' => 'required',
            'reference' => 'required',
            'stock' => 'required',
            'currency' => 'required',
            'price' => 'required',
        ]);

        $values = [];
        $values['description'] = $request->input('description');
        $values['reference'] = $request->input('reference');
        $values['stock'] = $request->input('stock');
        $values['currency'] = $request->input('currency');
        $values['price'] = $request->input('price');

        if ($validator->passes()) {
            //TODO Handle your data
            $result = $this->database->insert('product', $values);

            return $this->handlers($result);
        } else {
            //TODO Handle your error
            //dd($validator->errors()->all());
            return response()->json(['message' => $validator->errors()->all(), "status" => false], 400);
        }


    }

    public function edit(Request $request, $id)
    {

        $validator =  Validator::make($request->all(), [
            'description' => 'required',
            'reference' => 'required',
            'stock' => 'required',
            'currency' => 'required',
            'price' => 'required',
        ]);

        $values = [];
        $values['description'] = $request->input('description');
        $values['reference'] = $request->input('reference');
        $values['stock'] = $request->input('stock');
        $values['currency'] = $request->input('currency');
        $values['price'] = $request->input('price');

        if ($validator->passes()) {
            //TODO Handle your data
            $result =  $this->database->update('product', $values, ['id' => $request->input('id')]);

            return $this->handlers($result);
        } else {
            //TODO Handle your error
            //dd($validator->errors()->all());
            return response()->json(['message' => $validator->errors()->all(), "status" => false], 400);
        }
    }

    public function destroy(Request $request, $id)
    {

        $validator =  Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->passes()) {
            //TODO Handle your data
            $result = $this->database->delete('product', ['id' => $request->input('id')]);

            return $this->handlers($result);
        } else {
            //TODO Handle your error
            //dd($validator->errors()->all());
            return response()->json(['message' => $validator->errors()->all(), "status" => false], 400);
        }
    }


    public function handlers($result)
    {
        if ($this->database->error()[0] != 00000) {
            $msj['success'] = false;
            $msj['status'] = false;
            $msj['error'] = $this->database->error();
            $msj['sql'] = $this->database->log();
        } else {
            $msj['success'] = true;
            $msj['status'] = true;
            //$msj['sql'] = $this->database->log();
            $msj['count'] = method_exists($result, 'rowCount') ? $result->rowCount() : count($result);
            $msj['message'] = 'Proceso Enviado';
            $msj['data'] = $result;
        }

        return $msj;
    }
}
