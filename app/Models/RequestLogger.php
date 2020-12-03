<?php

namespace App\Models;

use App\Models\Request;

class RequestLogger
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    private function logRequest()
    {
        try
        {
            $request = Request::find($this->id);
            if($request)
            {
                $request->requests_amount++;
            }
            else 
            { 
                $request = new Request;
                $request->id = $this->id;
            }
            $request->save();
        }
        catch(\Exception $e)
        {
            \Log::error($e->getMessage());
        }

    }

}
