<?php
namespace GP247\Shop\Controllers;

use GP247\Front\Controllers\RootFrontController;
use GP247\Core\Models\AdminCountry;
use GP247\Shop\Models\ShopOrder;
use GP247\Shop\Models\ShopOrderStatus;
use GP247\Shop\Models\ShopShippingStatus;
use GP247\Shop\Models\ShopCustomer;
use GP247\Core\Models\AdminCustomField;
use GP247\Shop\Models\ShopAttributeGroup;
use GP247\Shop\Models\ShopCustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use GP247\Shop\Controllers\Auth\AuthTrait;
use GP247\Shop\Admin\Models\AdminOrder;


class ShopAccountController extends RootFrontController
{
    use AuthTrait;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Index user profile
     *
     * @return  [view]
     */
    public function index()
    {
        $customer = customer()->user();
        
        $subPath = 'account.index';
        $view = gp247_shop_process_view($this->GP247TemplatePath,$subPath);
        gp247_check_view($view);
        return view($view)
            ->with(
                [
                    'title'       => gp247_language_render('customer.my_account'),
                    'customer'    => $customer,
                    'layout_page' => 'shop_profile',
                    'breadcrumbs' => [
                        ['url'    => '', 'title' => gp247_language_render('customer.my_account')],
                    ],
                ]
            );
    }


    /**
     * Form Change password
     *
     * @return  [view]
     */
    public function changePassword()
    {
        $customer = customer()->user();

        $subPath = 'account.change_password';
        $view = gp247_shop_process_view($this->GP247TemplatePath,$subPath);
        gp247_check_view($view);
        return view($view)
        ->with(
            [
                'title'       => gp247_language_render('customer.change_password'),
                'customer'    => $customer,
                'layout_page' => 'shop_profile',
                'breadcrumbs' => [
                    ['url'    => gp247_route_front('customer.index'), 'title' => gp247_language_render('customer.my_profile')],
                    ['url'    => '', 'title' => gp247_language_render('customer.change_password')],
                ],
            ]
        );
    }

    /**
     * Post change password
     *
     * @param   Request  $request  [$request description]
     *
     * @return  [redirect]
     */
    public function postChangePassword(Request $request)
    {
        $dataUser = customer()->user();
        $password = $request->get('password');
        $password_old = $request->get('password_old');
        if (trim($password_old) == '') {
            return redirect()->back()
                ->with(
                    [
                        'password_old_error' => gp247_language_render('customer.password_old_required')
                    ]
                );
        } else {
            if (!\Hash::check($password_old, $dataUser->password)) {
                return redirect()->back()
                    ->with(
                        [
                            'password_old_error' => gp247_language_render('customer.password_old_notcorrect')
                        ]
                    );
            }
        }
        $messages = [
            'password.required' => gp247_language_render('validation.required', ['attribute'=> gp247_language_render('customer.password')]),
            'password.confirmed' => gp247_language_render('validation.confirmed', ['attribute'=> gp247_language_render('customer.password')]),
            'password_old.required' => gp247_language_render('validation.required', ['attribute'=> gp247_language_render('customer.password_old')]),
            'password.min' => gp247_language_render('validation.password.min', ['attribute'=> gp247_language_render('customer.password')]),
            'password.max' => gp247_language_render('validation.password.max', ['attribute'=> gp247_language_render('customer.password')]),
            'password.letters' => gp247_language_render('validation.password.letters', ['attribute'=> gp247_language_render('customer.password')]),
            'password.mixed' => gp247_language_render('validation.password.mixed', ['attribute'=> gp247_language_render('customer.password')]),
            'password.numbers' => gp247_language_render('validation.password.numbers', ['attribute'=> gp247_language_render('customer.password')]),
            'password.symbols' => gp247_language_render('validation.password.symbols', ['attribute'=> gp247_language_render('customer.password')]),
        ];
        $v = Validator::make(
            $request->all(),
            [
                'password_old' => 'required',
                'password' => gp247_customer_validate_password()['password_confirm'],
            ],
            $messages
        );
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        }
        $dataUser->password = bcrypt($password);
        $dataUser->save();

        return redirect(gp247_route_front('customer.index'))
            ->with(['success' => gp247_language_render('customer.update_success')]);
    }

    /**
     * Form change info
     *
     * @return  [view]
     */
    public function changeInfomation()
    {
        $customer = customer()->user();

        $subPath = 'account.change_infomation';
        $view = gp247_shop_process_view($this->GP247TemplatePath,$subPath);
        gp247_check_view($view);
        return view($view)
        ->with(
                [
                    'title'       => gp247_language_render('customer.change_infomation'),
                    'customer'    => $customer,
                    'countries'   => AdminCountry::getCodeAll(),
                    'layout_page' => 'shop_profile',
                    'customFields'=> (new AdminCustomField)->getCustomField($type = 'shop_customer'),
                    'breadcrumbs' => [
                        ['url'    => gp247_route_front('customer.index'), 'title' => gp247_language_render('customer.my_profile')],
                        ['url'    => '', 'title' => gp247_language_render('customer.change_infomation')],
                    ],
                ]
            );
    }

    /**
     * Process update info
     *
     * @param   Request  $request  [$request description]
     *
     * @return  [redirect]
     */
    public function postChangeInfomation(Request $request)
    {
        $user = customer()->user();
        $cId = $user->id;
        $data = request()->all();

        $v =  $this->validator($data);
        if ($v->fails()) {
            return redirect()->back()
                ->withErrors($v)
                ->withInput();
        }
        $user = $this->updateCustomer($data, $cId);

        return redirect(gp247_route_front('customer.index'))
            ->with(['success' => gp247_language_render('customer.update_success')]);
    }

    /**
     * Validate data input
     */
    protected function validator(array $data)
    {
        $dataMapp = $this->mappingValidatorEdit($data);
        return Validator::make($data, $dataMapp['validate'], $dataMapp['messages']);
    }

    /**
     * Update data customer
     */
    protected function updateCustomer(array $data, string $cId)
    {
        $dataMapp = $this->mappingValidatorEdit($data);
        $user = ShopCustomer::updateInfo($dataMapp['dataUpdate'], $cId);

        return $user;
    }

    /**
     * Render order list
     * @return [view]
     */
    public function orderList()
    {
        $customer = customer()->user();
        $statusOrder = ShopOrderStatus::getIdAll();
        $subPath = 'account.order_list';
        $view = gp247_shop_process_view($this->GP247TemplatePath,$subPath);
        gp247_check_view($view);
        return view($view)
            ->with(
                [
                'title'       => gp247_language_render('customer.order_history'),
                'statusOrder' => $statusOrder,
                'orders'      => (new ShopOrder)->profile()->getData(),
                'customer'    => $customer,
                'layout_page' => 'shop_profile',
                'breadcrumbs' => [
                    ['url'    => gp247_route_front('customer.index'), 'title' => gp247_language_render('customer.my_profile')],
                    ['url'    => '', 'title' => gp247_language_render('customer.order_history')],
                ],
                ]
            );
    }


    /**
     * Render order detail
     * @return [view]
     */
    public function orderDetail($id)
    {
        $customer = customer()->user();
        $statusOrder = ShopOrderStatus::getIdAll();
        $statusShipping = ShopShippingStatus::getIdAll();
        $attributesGroup = ShopAttributeGroup::pluck('name', 'id')->all();
        $order = ShopOrder::where('id', $id) ->where('customer_id', $customer->id)->first();
        if ($order) {
            $title = gp247_language_render('customer.order_detail').' #'.$order->id;
        } else {
            return $this->pageNotFound();
        }
        $subPath = 'account.order_detail';
        $view = gp247_shop_process_view($this->GP247TemplatePath,$subPath);
        gp247_check_view($view);
        return view($view)
        ->with(
            [
            'title'           => $title,
            'statusOrder'     => $statusOrder,
            'statusShipping'  => $statusShipping,
            'countries'       => AdminCountry::getCodeAll(),
            'attributesGroup' => $attributesGroup,
            'order'           => $order,
            'customer'        => $customer,
            'layout_page'     => 'shop_profile',
            'breadcrumbs'     => [
                ['url'        => gp247_route_front('customer.index'), 'title' => gp247_language_render('customer.my_profile')],
                ['url'        => '', 'title' => $title],
            ],
            ]
        );
    }


    /**
     * Render address list
     * @return [view]
     */
    public function addressList()
    {
        $customer = customer()->user();
        $subPath = 'account.address_list';
        $view = gp247_shop_process_view($this->GP247TemplatePath,$subPath);
        gp247_check_view($view);
        return view($view)
            ->with(
                [
                'title'       => gp247_language_render('customer.address_list'),
                'addresses'   => $customer->addresses,
                'countries'   => AdminCountry::getCodeAll(),
                'customer'    => $customer,
                'layout_page' => 'shop_profile',
                'breadcrumbs' => [
                    ['url'    => gp247_route_front('customer.index'), 'title' => gp247_language_render('customer.my_profile')],
                    ['url'    => '', 'title' => gp247_language_render('customer.address_list')],
                ],
                ]
            );
    }

    /**
     * Render address detail
     * @return [view]
     */
    public function updateAddress($id)
    {
        $customer = customer()->user();
        $address =  (new ShopCustomerAddress)->where('customer_id', $customer->id)
            ->where('id', $id)
            ->first();
        if ($address) {
            $title = gp247_language_render('customer.address_detail');
        } else {
            return $this->pageNotFound();
        }
        $subPath = 'account.update_address';
        $view = gp247_shop_process_view($this->GP247TemplatePath,$subPath);
        gp247_check_view($view);
        return view($view)
        ->with(
            [
            'title'       => $title,
            'address'     => $address,
            'customer'    => $customer,
            'countries'   => AdminCountry::getCodeAll(),
            'layout_page' => 'shop_profile',
            'breadcrumbs' => [
                ['url'    => gp247_route_front('customer.index'), 'title' => gp247_language_render('customer.my_profile')],
                ['url'    => '', 'title' => $title],
            ],
            ]
        );
    }

    /**
     * Process update address
     *
     * @param   Request  $request  [$request description]
     *
     * @return  [redirect]
     */
    public function postUpdateAddress($id)
    {
        $customer = customer()->user();
        $data = request()->all();
        $address =  (new ShopCustomerAddress)->where('customer_id', $customer->id)
            ->where('id', $id)
            ->first();
        
        $dataMapp = gp247_customer_address_mapping($data);
        $dataUpdate = $dataMapp['dataAddress'];
        $validate = $dataMapp['validate'];
        $messages = $dataMapp['messages'];

        $v = Validator::make(
            $dataUpdate,
            $validate,
            $messages
        );
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        }

        $address->update(gp247_clean($dataUpdate));

        if (!empty($data['default'])) {
            (new ShopCustomer)->find($customer->id)->update(['address_id' => $id]);
        }
        return redirect(gp247_route_front('customer.address_list'))
            ->with(['success' => gp247_language_render('customer.update_success')]);
    }

    /**
     * Get address detail
     *
     * @return  [json]
     */
    public function getAddress()
    {
        $customer = customer()->user();
        $id = request('id');
        $address =  (new ShopCustomerAddress)->where('customer_id', $customer->id)
            ->where('id', $id)
            ->first();
        if ($address) {
            return $address->toJson();
        } else {
            return $this->pageNotFound();
        }
    }

    /**
     * Get address detail
     *
     * @return  [json]
     */
    public function deleteAddress()
    {
        $customer = customer()->user();
        $id = request('id');
        (new ShopCustomerAddress)->where('customer_id', $customer->id)
            ->where('id', $id)
            ->delete();
        return json_encode(['error' => 0, 'msg' => gp247_language_render('customer.delete_address_success')]);
    }

    /**
     * _verification function
     *
     * @return void
     */
    public function verification()
    {
        $customer = customer()->user();
        if (!$customer->hasVerifiedEmail()) {
            return redirect(gp247_route_front('customer.index'));
        }
        $subPath = 'account.verify';
        $view = gp247_shop_process_view($this->GP247TemplatePath,$subPath);
        gp247_check_view($view);
        return view($view)
            ->with(
                [
                    'title' => gp247_language_render('customer.verify_email.title_page'),
                    'customer' => $customer,
                ]
            );
    }

    /**
     * Resend email verification
     *
     * @return void
     */
    public function resendVerification()
    {
        $customer = customer()->user();
        if (!$customer->hasVerifiedEmail()) {
            return redirect(gp247_route_front('customer.index'));
        }
        $resend = $customer->sendEmailVerify();

        if ($resend) {
            return redirect()->back()->with('resent', true);
        }
    }

    /**
     * Process Verification
     *
     * @param [type] $id
     * @param [type] $token
     * @return void
     */
    public function verificationProcessData(Request $request, $id = null, $token = null)
    {
        $arrMsg = [
            'error' => 0,
            'msg' => '',
            'detail' => '',
        ];
        $customer = customer()->user();
        if (!$customer) {
            $arrMsg = [
                'error' => 1,
                'msg' => gp247_language_render('customer.verify_email.link_invalid'),
            ];
        } elseif ($customer->id != $id) {
            $arrMsg = [
                'error' => 1,
                'msg' => gp247_language_render('customer.verify_email.link_invalid'),
            ];
        } elseif (sha1($customer->email) != $token) {
            $arrMsg = [
                'error' => 1,
                'msg' => gp247_language_render('customer.verify_email.link_invalid'),
            ];
        }
        if (! $request->hasValidSignature()) {
            abort(401);
        }
        if ($arrMsg['error']) {
            return redirect(route('front.home'))->with(['error' => $arrMsg['msg']]);
        } else {
            $customer->update(['email_verified_at' => \Carbon\Carbon::now()]);
            return redirect(gp247_route_front('customer.index'))->with(['message' => gp247_language_render('customer.verify_email.verify_success')]);
        }
    }
    
    
     public function invoice($id)
    {
        $orderId = $id ?? null;
        $order = AdminOrder::getOrderAdmin($orderId);
        if ($order) {
            $data                    = array();
            $data['name']            = $order['first_name'] . ' ' . $order['last_name'];
            $data['address']         = $order['address1'] . ', ' . $order['address2'] . ', ' . $order['address3'].', '.$order['country'];
            $data['phone']           = $order['phone'];
            $data['email']           = $order['email'];
            $data['comment']         = $order['comment'];
            $data['payment_method']  = $order['payment_method'];
            $data['shipping_method'] = $order['shipping_method'];
            $data['created_at']      = $order['created_at'];
            $data['currency']        = $order['currency'];
            $data['exchange_rate']   = $order['exchange_rate'];
            $data['subtotal']        = $order['subtotal'];
            $data['tax']             = $order['tax'];
            $data['shipping']        = $order['shipping'];
            $data['discount']        = $order['discount'];
            $data['total']           = $order['total'];
            $data['received']        = $order['received'];
            $data['balance']         = $order['balance'];
            $data['other_fee']       = $order['other_fee'] ?? 0;
            $data['comment']         = $order['comment'];
            $data['country']         = $order['country'];
            $data['id']              = $order->id;
            $data['details'] = [];

            $attributesGroup =  ShopAttributeGroup::pluck('name', 'id')->all();

            if ($order->details) {
                foreach ($order->details as $key => $detail) {
                    $arrAtt = json_decode($detail->attribute, true);
                    if ($arrAtt) {
                        $htmlAtt = '';
                        foreach ($arrAtt as $groupAtt => $att) {
                            $htmlAtt .= $attributesGroup[$groupAtt] .':'.gp247_render_option_price($att, $order['currency'], $order['exchange_rate']);
                        }
                        $name = $detail->name.'('.strip_tags($htmlAtt).')';
                    } else {
                        $name = $detail->name;
                    }
                    $data['details'][] = [
                        'no' => $key + 1, 
                        'sku' => $detail->sku, 
                        'name' => $name, 
                        'qty' => $detail->qty, 
                        'price' => $detail->price, 
                        'total_price' => $detail->total_price,
                    ];
                }
            }

            return view('gp247-core::format.invoice')
            ->with($data);
        } else {
            return redirect()->route('admin.data_not_found')->with(['url' => url()->full()]);
        }
    }
    
    public function activeservice()
    {
        
        $customer = customer()->user();
        $statusOrder = ShopOrderStatus::getIdAll();
        $subPath = 'account.activestatus';
        $view = gp247_shop_process_view($this->GP247TemplatePath,$subPath);
        gp247_check_view($view);
        return view($view)
            ->with(
                [
                'title'       => 'Active Status',
                'statusOrder' => $statusOrder,
                'orders'      => (new ShopOrder)->profile()->getData(),
                'customer'    => $customer,
                'layout_page' => 'shop_profile',
                'breadcrumbs' => [
                    ['url'    => gp247_route_front('customer.index'), 'title' => gp247_language_render('customer.my_profile')],
                    ['url'    => '', 'title' => gp247_language_render('customer.order_history')],
                ],
                ]
            );
        
        
    }
    
}
