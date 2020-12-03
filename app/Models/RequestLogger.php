<?php

namespace App\Models;

use App\Models\RequestLog;

class RequestLogger
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function logRequest()
    {
        try
        {
            $request = RequestLog::find($this->id);
            if($request)
            {
                $request->requests_amount++;
            }
            else 
            { 
                $request = new RequestLog;
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
