<?php
namespace SaineshMamgain\SetupHelper\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

/**
 * File: BaseRequest.php
 * Date: 13/07/20
 * Author: Sainesh Mamgain <saineshmamgain@gmail.com>
 */

abstract class BaseRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch (strtolower($this->method())) {
            case "post":
                return $this->postMethodRules();
            case "put":
                return $this->putMethodRules();
            case "patch":
                return $this->patchMethodRules();
            case "get":
                return $this->getMethodRules();
            case "delete":
                return $this->deleteMethodRules();
        }
    }
}
