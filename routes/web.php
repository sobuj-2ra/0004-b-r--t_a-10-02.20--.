<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/port', 'portController@add_port');
Route::post('/port/save', 'portController@save_port');
Route::post('first-user', [ 'as' => 'first-user', 'uses' => 'UserController@save_first_user']);

Route::group(['middleware' => ['auth']], function () {

    Route::get('rap/pap', 'rappapController@index');
    Route::post('rap/pap/save', 'rappapController@save');
    Route::get('rap/listview', 'rappapController@listview');

    /*New added*/

    Route::post('/store-user', 'HomeController@store')->name('store');

    Route::get('/create', 'HomeController@create');
    Route::get('/user-list', 'HomeController@user_list');
    Route::get('/search-center-name', 'HomeController@search_center_name');
    Route::get('/search-menu-permission', 'HomeController@search_menu_permission');
    Route::get('/delete_user/{a}', 'HomeController@delete_user');
    Route::get('/edit_user/{a}', 'HomeController@edit_user');
    Route::post('/update_user', 'HomeController@update_user');
    Route::get('/change-password', 'HomeController@change_password');
    Route::post('/password-changed', 'HomeController@password_changed');
    Route::get('/search-branch-name', 'HomeController@search_branch_name');
    Route::get('/search-old-password', 'HomeController@search_old_password');

    Route::get('menu/index', 'MenuController@index');

    Route::get('menu/create', 'MenuController@create');
    Route::post('menu/store', 'MenuController@store')->name('store');

//ADDITIONAL SERVICES
    Route::get('/search', 'ApplicantController@index');
    Route::post('search', 'ApplicantController@search');
    Route::post('/store', 'ApplicantController@store')->name('updateSearch');


    //RapPap approval, edit page and final report

    Route::get('/print', 'PrintController@index')->name('print');
    Route::post('/accept', 'PrintController@store')->name('approval');
    Route::post('/ajax/{id}', 'PrintController@ajax');
    Route::get('/edit', 'PrintController@edit')->name('rap.edit');
    Route::post('/update', 'PrintController@update');
    Route::post('/rePrint', 'PrintController@rePrint');
    Route::get('/delete/passport/{serial_no}', 'PrintController@destroy')->name('user.delete');


    /*New added*/

    Route::get('approve/report', 'RappapController@approveview')->name('report');

    Route::post('approve/detail', 'RappapController@approvedetail');

    /*Export-Import*/
    Route::get('export/data', 'exportimportController@export');

    Route::get('import/data', 'exportimportController@import');
    /*Export-Import*/

    Route::post('importExcel', 'exportimportController@importExcel');
    Route::post('data/export', 'exportimportController@excel');


    //Summary Report
    Route::get('/port-update-report', 'ReportsController@port_update_report_view_page');
    Route::post('/port-update-report-result', 'ReportsController@port_update_report_result');

    //    sticker
    Route::get('/sticker', 'StickerController@index');
    Route::post('/store-sticker', 'StickerController@store');
    Route::get('/sticker-list', 'StickerController@sticker_view');
    Route::get('/delete_sticker/{id}', 'StickerController@destroy');
    Route::get('/edit_sticker/{id}', 'StickerController@edit');
    Route::post('/update-sticker', 'StickerController@update');

//    rap-pap
    Route::get('rap/pap/{a}/{b}/{c}/{d}/','rappapController@index');
    //Route::get('/new/rap/pap/{a}/{b}/{c}/{d}/','rappapController@index2Print');
    Route::post('rap/pap/save','rappapController@save');

    /*Edit Rap/Pap*/
    Route::get('rap/pap/edit/{a}/{b}', 'rappapController@edit');
    Route::post('rap/pap/edit/action', 'rappapController@edit_action');

    Route::post('rap/pap/edit/save/{a}', 'rappapController@edit_save');

    //Route::get('rap/pap/delete/{a}/{b}', 'rappapController@delete_rappap');
    /*delete Rap/Pap*/
    Route::get('/delete-rappap', 'rappapController@delete_page');
    Route::get('/delete-rappap/{a}', 'rappapController@delete');
    Route::post('rappap/delete-search', 'rappapController@delete_page');

    /*Receive Report*/
    Route::get('rappap/report', 'RappapController@viewreport')->name('report');

    Route::post('rappap/detail', 'RappapController@report_detail');

    /*Receive summary Report*/
    Route::get('/receive-summary-report', 'ReportController@receive_summary_report_view_page');
    Route::post('/receive-summary-report-result', 'ReportController@receive_summary_report_result');

    /*Designation start*/
    Route::get('/designation/add','DesignationController@add');
    Route::post('designation/add/save','DesignationController@save');
    Route::get('/edit_designation/{id}', 'DesignationController@edit_designation');
    Route::get('/update_designation', 'DesignationController@update_designation');
    Route::get('/delete_designation/{id}', 'DesignationController@delete_designation');

    //    sticker
    Route::get('/sticker', 'StickerController@index');
    Route::post('/store-sticker', 'StickerController@store');
    Route::get('/delete_sticker/{id}', 'StickerController@destroy');
    Route::get('/edit_sticker/{id}', 'StickerController@edit');
    Route::post('/update-sticker', 'StickerController@update');
    Route::get('/search-center-for-region', 'StickerController@search_center');

    //  entry / exit port
    Route::get('/entry-exit-port', 'EntryExitController@index');
    Route::post('/entry-exit-port/store', 'EntryExitController@store');
    Route::get('/port-delete/{id}', 'EntryExitController@destroy');
    Route::get('/edit-entry-exit-port/{id}', 'EntryExitController@edit');
    Route::post('/entry-exit-port/update', 'EntryExitController@update');

//  area
    Route::get('/area', 'AreaController@index');
    Route::post('/area/store', 'AreaController@store');
    Route::get('/area-port-delete/{id}', 'AreaController@destroy');
    Route::get('/edit-area-port/{id}', 'AreaController@edit');
    Route::post('/area/update', 'AreaController@update');

//    mode
    Route::get('/mode', 'ModeController@index');
    Route::post('/mode/store', 'ModeController@store');
    Route::get('/mode-port-delete/{id}', 'ModeController@destroy');
    Route::get('/edit-mode-port/{id}', 'ModeController@edit');
    Route::post('/mode/update', 'ModeController@update');


//    create menu
    Route::get('/search-sub-menu', 'MenuController@search_sub_menu');

//    center
    Route::get('/center-add', 'CenterController@index');
    Route::post('/store-center-name', 'CenterController@store');
    Route::get('/edit-center/{a}', 'CenterController@edit');
    Route::post('/update-center', 'CenterController@update');
    Route::get('/delete-center/{a}', 'CenterController@destroy');

//    center type
    Route::get('/center-type-add', 'CenterController@center_type_add');
    Route::post('/store-center-type', 'CenterController@store_center_type');
    Route::get('/edit-center-type/{a}', 'CenterController@edit_center_type');
    Route::post('/update-center-type', 'CenterController@update_center_type');
    Route::get('/delete-center-type/{a}', 'CenterController@destroy_center_type');

    //Basic print page
    Route::get('hci/basic/print','PrintController@basic')->name('basic');
    Route::post('/hci/basic/printPage', 'PrintController@basicStore');

    Route::get('visa', 'VisaController@index');
    Route::post('visa/store', 'VisaController@store');
    Route::get('/edit-visa-type/{a}', 'VisaController@edit');
    Route::post('/visa/update', 'VisaController@update');
    Route::get('/visa-type-delete/{a}', 'VisaController@destroy');

    Route::get('passport-reprint', 'PrintController@passport_reprint');

//    dollar endorsement
    Route::get('dollar_endorsement', 'DollarEndorsementController@index');
    Route::get('/search-dollar-rate', 'DollarEndorsementController@search_dollar_rate');
    Route::post('dollar/store', 'DollarEndorsementController@store');
    Route::get('/dollar_endorsement/{a}', 'DollarEndorsementController@printData');
    Route::get('/reprint-dollar_endorsement/{a}', 'DollarEndorsementController@reprintData');
    Route::get('/search-passport-appointment', 'DollarEndorsementController@search_passport_appointment');
    Route::get('/edit-dollar-endorsement', 'DollarEndorsementController@show');
    Route::get('/reprint-dollar-endorsement', 'DollarEndorsementController@reprint');
    Route::post('dollar-Endorsement/edit-search', 'DollarEndorsementController@show');
    Route::post('dollar/edit', 'DollarEndorsementController@update');
    Route::get('/dollar_endorsement_edit/{a}', 'DollarEndorsementController@edit_printData');
    Route::get('/export-dollar-endorsement', 'DollarEndorsementController@excel_page');
    Route::post('/dollar/export', 'DollarEndorsementController@excel');
    Route::get('/transaction-voucher', 'DollarEndorsementController@transaction_voucher');
    Route::get('print-transaction-voucher', 'DollarEndorsementController@transaction_voucher');
    Route::get('print-transaction-voucher/{a}', 'DollarEndorsementController@transaction_voucher_print');
    Route::get('edit-print-transaction-voucher/{a}', 'DollarEndorsementController@transaction_voucher_edit_print');
    Route::get('/tm-form', 'DollarEndorsementController@tm_form');
    Route::get('/print-tm-form', 'DollarEndorsementController@tm_form');
    Route::get('/tm-form-print/{a}', 'DollarEndorsementController@tm_form_print');
    Route::get('/dollar_endorsement/m/{a}', 'DollarEndorsementController@index2');
    Route::get('/dollar_endorsement/edit/{a}', 'DollarEndorsementController@edit_print');
    Route::get('/enquiry-dollar', 'DollarEndorsementController@enquiry');
    Route::get('search-enquiry', 'DollarEndorsementController@enquiry');
    Route::get('/dollar_endorsement/receive-print/{a}', 'DollarEndorsementController@receive_voucher');
    Route::get('/dollar_endorsement/edit-receive-print/{a}', 'DollarEndorsementController@edit_receive_voucher');
    Route::get('/delete-dollar', 'DollarEndorsementController@delete_page');
    Route::post('dollar-Endorsement/delete-search', 'DollarEndorsementController@delete_page');
    Route::get('/delete-dollar/{a}', 'DollarEndorsementController@destroy');
    Route::get('/reprint-receive-voucher', 'DollarEndorsementController@reprint_receive_voucher');
    Route::post('/reprint-receive-voucher', 'DollarEndorsementController@reprint_receive_voucher');
    Route::get('/dollarendorsement-reference-by', 'DollarEndorsementController@reference_by');
    Route::post('reference/store', 'DollarEndorsementController@reference_by_store');
    Route::get('delete_refer/{a}', 'DollarEndorsementController@reference_delete');
    Route::get('edit_referrer/{a}', 'DollarEndorsementController@edit_referrer_page');
    Route::post('reference/update', 'DollarEndorsementController@reference_update');
    Route::get('/search-referred-id', 'DollarEndorsementController@search_referred_id');

//    dollar report
    Route::get('/dollar-endorsement-details', 'DollarEndorsementController@details_report');
    Route::get('/dollar-endorsement-summary', 'DollarEndorsementController@summary_report');
    Route::post('/dollar-details-report-search', 'DollarEndorsementController@search_details_report');
    Route::post('/dollar-summary-report-search', 'DollarEndorsementController@search_summary_report');
    Route::get('/referred-details', 'DollarEndorsementController@referred_details');
    Route::post('/dollar-referred-report-search', 'DollarEndorsementController@referred_details_report');
    Route::get('/referred-summary', 'DollarEndorsementController@referred_summary');
    Route::post('/dollar-referred-summary-report', 'DollarEndorsementController@referred_summary_report');

//    currency rate
    Route::get('currency', 'CurrencyController@index');
    Route::post('currency/add', 'CurrencyController@store');
    Route::get('delete_currency/{a}', 'CurrencyController@destroy');
    Route::get('edit_currency/{a}', 'CurrencyController@edit');
    Route::post('currency/update', 'CurrencyController@update');
//    services
    Route::get('/services', 'Services@index');
    Route::post('service/store', 'Services@store');
    Route::get('/services-delete/{a}', 'Services@destroy');
    Route::get('/edit-services/{a}', 'Services@edit');
    Route::post('service/update', 'Services@update');
//    appointment import
    Route::get('/import-appointment', 'AppointmentController@index');
    Route::post('/appointment-import', 'AppointmentController@import');
    //foreign-passport-receive
    Route::get('/foreign-passport-receive', 'ForeignPassportController@index');
    Route::post('store-foreign-passport', 'ForeignPassportController@store');
    Route::get('/foreign-passport-receive/{a}/{b}/{c}/{d}', 'ForeignPassportController@after_submit');
    Route::get('/search-sticker-numbers', 'ForeignPassportController@search_sticker_number');
    Route::get('/money-receive-book', 'ForeignPassportController@money_receive_book');
    Route::post('book/store', 'ForeignPassportController@money_receive_book_store');
    Route::get('edit_money_receive/{a}', 'ForeignPassportController@edit_money_receive');
    Route::post('book/update', 'ForeignPassportController@update_money_receive');
    Route::get('delete_money_receive/{a}', 'ForeignPassportController@delete_money_receive');
    Route::get('/search-receive-number', 'ForeignPassportController@search_receive_number');
    Route::get('/edit-receive-foreign-passport', 'ForeignPassportController@edit_receive_foreign_passport');
    Route::post('/edit-receive-foreign-passport/search', 'ForeignPassportController@edit_receive_foreign_passport');
    Route::post('update-foreign-passport', 'ForeignPassportController@update_foreign_passport');
    Route::get('edit-foreign-passport-slip-copy-gratise/{a}', 'ForeignPassportController@edit_foreign_passport_slip_copy_gratise');
    Route::get('/delete-foreign-passport', 'ForeignPassportController@delete_page');
    Route::post('foreign/delete-search', 'ForeignPassportController@delete_page');
    Route::get('/delete-foreign/{a}', 'ForeignPassportController@destroy');
    Route::get('/reprint-foreign-passport', 'ForeignPassportController@reprint');
    Route::post('/foreign/reprint-search', 'ForeignPassportController@reprint');

//    foreign passport report

    Route::get('/visa-fee-collection-report', 'ForeignPassportController@visa_fee_collection_report');
    Route::post('foreign-visa-fee-collection-report-search', 'ForeignPassportController@foreign_visa_fee_collection_report_search');
    Route::get('foreign-passport-slip-copy/{a}/{b}/{c}/{d}/{e}', 'ForeignPassportController@foreign_passport_slip_copy');
    Route::get('foreign-passport-slip-copy-gratise/{a}/{b}', 'ForeignPassportController@foreign_passport_slip_copy_gratise');
    Route::get('/foreign-details-report', 'ForeignPassportController@foreign_details_report');
    Route::post('foreign-details-report-search', 'ForeignPassportController@foreign_details_report_search');
    Route::get('/foreign-summary', 'ForeignPassportController@foreign_summary');
    Route::post('foreign-summary-report-search', 'ForeignPassportController@foreign_summary_report_search');



    //  port endorsement

    Route::get('/portendorsement/{a}/{b}/{c}/{d}', 'PortEndorsementController@index');
    Route::post('/portendorsement/save', 'PortEndorsementController@save');
    Route::get('/port-search-sticker-numbers', 'PortEndorsementController@port_search_sticker_numbers');

    Route::post('/update_portendorsement', 'PortEndorsementController@update');
    Route::get('/portendorsement/edit/{id}', 'PortEndorsementController@edit_view');
    Route::get('/portendorsement/{a}/{b}/{c}/{d}/{e}', 'PortEndorsementController@printData');
    Route::get('/portendorsement/re_print', 'PortEndorsementController@reprint');
    Route::post('port/reprint-search', 'PortEndorsementController@reprint');
    Route::get('/port-details-report', 'PortEndorsementController@details_report');
    Route::get('/port-summary-report', 'PortEndorsementController@summary_report');
    Route::post('port-details-report-search', 'PortEndorsementController@port_details_report_search');
    Route::post('port-summary-report-search', 'PortEndorsementController@port_summary_report_search');
    Route::get('edit-port-endorsement', 'PortEndorsementController@edit_port_endorsement');
    Route::post('/edit-port-endorsement/search', 'PortEndorsementController@edit_port_endorsement');
    Route::get('/delete_portendorsement', 'PortEndorsementController@destroy_view');
    Route::post('/delete_portendorsement-search', 'PortEndorsementController@destroy_view');
    Route::get('/delete-port/{a}', 'PortEndorsementController@destroy');
    Route::get('/edit-port-endorsement-print/{a}', 'PortEndorsementController@edit_printData');

//Branch Name
    Route::get('/branch-name', 'BranchController@index');
    Route::post('/store-branch-name', 'BranchController@store');
    Route::get('/edit-branch/{a}', 'BranchController@edit');
    Route::post('/update-branch-name', 'BranchController@update');
    Route::get('/delete-branch/{a}', 'BranchController@destroy');

    //holiday
    Route::get('/add-holiday', 'HolidayController@index');
    Route::post('store-holiday', 'HolidayController@store');
    Route::get('/delete-holiday/{a}', 'HolidayController@destroy');
    Route::get('/edit-holiday/{a}', 'HolidayController@edit');
    Route::post('/update-holiday', 'HolidayController@update');


//    download
    Route::get('details/{a}/{b}/{c}/{d}', 'PDFController@index');
    Route::get('referred/{a}/{b}/{c}/{d}', 'PDFController@referred');
    Route::get('/referred-summary/{a}/{b}/{c}/{d}', 'PDFController@referred_summary');
    Route::get('summary/{a}/{b}/{c}/{d}', 'PDFController@summary_dollar');
    Route::get('details-rappap/{a}/{b}/{c}/{d}/{e}/{f}', 'PDFController@details_rap_pap');
    Route::get('receive-summary-rappap/{a}/{b}/{c}/{d}', 'PDFController@receive_summary_rappap');
    Route::get('receive-summary-port/{a}/{b}/{c}/{d}/{f}', 'PDFController@receive_summary_port');
    Route::get('approve-detail/{a}/{b}/{c}/{d}/{e}', 'PDFController@approve_detail_rappap');
    Route::get('rappap-all-report/{a}/{b}/{c}/{d}', 'PDFController@rappap_all_report');
    Route::get('/fee-collection/{a}/{b}/{c}', 'PDFController@fee_collection');
    Route::get('/foreign-details/{a}/{b}/{c}/{d}', 'PDFController@foreign_details');
    Route::get('/foreign-summary/{a}/{b}/{c}/{d}', 'PDFController@foreign_summary');
    Route::get('/details-port/{a}/{b}/{c}/{d}/{e}', 'PDFController@details_port');

    //account type; controller name is BranchController
    Route::get('/account-type', 'BranchController@add_account_type');
    Route::post('/store-account-name', 'BranchController@store_account_name');
    Route::get('/delete-account-name/{a}', 'BranchController@delete_account_name');
    Route::get('/edit-account-name/{a}', 'BranchController@edit_account_name');
    Route::post('/update-account-name', 'BranchController@update_account_name');

//    add commission; controller name is BranchController
    Route::get('/add-commission', 'BranchController@add_commission');
    Route::post('/store-commission', 'BranchController@store_commission');
    Route::get('/delete-commission/{a}', 'BranchController@delete_commission');
    Route::get('/edit-commission/{a}', 'BranchController@edit_commission');
    Route::post('/update-commission', 'BranchController@update_commission');

//    delivery to app
    Route::get('/delivery_to_app', 'ReceiveDeliveryController@index');
    Route::post('search/del-to-app', 'ReceiveDeliveryController@search');
    Route::post('/update-del-to-app', 'ReceiveDeliveryController@store')->name('/update-del-to-app');
    Route::get('/port-delivery-to-app', 'ReceiveDeliveryController@port_del_to_app');
    Route::get('/foreign-delivery-to-app', 'ReceiveDeliveryController@foreign_del_to_app');
    Route::get('/delete-del-app-foreign', 'ReceiveDeliveryController@delete_foreign_del_to_app');
    Route::get('/delete-del-ready-port', 'ReceiveDeliveryController@delete_port_del_to_app');
    Route::get('/delete-del-ready-rappap', 'ReceiveDeliveryController@delete_rappap_del_to_app');
    Route::post('del2app/foreign/delete-search', 'ReceiveDeliveryController@delete_foreign_del_to_app');
    Route::post('del2app/port/delete-search', 'ReceiveDeliveryController@delete_port_del_to_app');
    Route::post('del2app/rappap/delete-search', 'ReceiveDeliveryController@delete_rappap_del_to_app');
    Route::get('/delete-foreign/delready/{a}/{b}', 'ReceiveDeliveryController@delete_foreign_del_to_app_action');
    Route::get('/delete-port/delready/{a}/{b}', 'ReceiveDeliveryController@delete_port_del_to_app_action');
    Route::get('/delete-rappap/delready/{a}/{b}', 'ReceiveDeliveryController@delete_rappap_del_to_app_action');


//    duration
    Route::get('/add-duration', 'CenterController@add_duration');
    Route::post('/duration/store', 'CenterController@duration_store');
    Route::get('edit_duration/{a}', 'CenterController@duration_edit');
    Route::post('duration/update', 'CenterController@duration_update');
    Route::get('delete_duration/{a}', 'CenterController@duration_delete');

//    entry type
    Route::get('/add-entry-type', 'CenterController@add_entry_type');
    Route::post('/entry/store', 'CenterController@entry_store');
    Route::get('edit_entry/{a}', 'CenterController@entry_edit');
    Route::post('entry/update', 'CenterController@entry_update');
    Route::get('delete_entry/{a}', 'CenterController@entry_delete');


    // del2app report
    Route::get('/foreign-passport-del-app-details', 'ReceiveDeliveryController@foreign_details');
    Route::get('/foreign-del-app-summary', 'ReceiveDeliveryController@foreign_summary');
    Route::get('/port-del-app-detail', 'ReceiveDeliveryController@port_details');
    Route::get('/port-del-app-summary', 'ReceiveDeliveryController@port_summary');
    Route::get('/rappap-del-app-details', 'ReceiveDeliveryController@rappap_details');
    Route::get('/rappap-del-app-summary', 'ReceiveDeliveryController@rappap_summary');
    Route::post('foreign-del-app-details-search', 'ReceiveDeliveryController@foreign_details_search');
    Route::post('foreign-del-app-summary-search', 'ReceiveDeliveryController@foreign_summary_search');
    Route::post('port-del-app-details-search', 'ReceiveDeliveryController@port_details_search');
    Route::post('port-del-app-summary-search', 'ReceiveDeliveryController@port_summary_search');
    Route::post('rappap-del-app-details-search', 'ReceiveDeliveryController@rappap_details_search');
    Route::post('rappap-del-app-summary-search', 'ReceiveDeliveryController@rappap_summary_search');

    //ready center /foreign-ready-center
    Route::get('/foreign-ready-center', 'ReceiveDeliveryController@foreign_ready_center');
    Route::post('search_ready_center', 'ReceiveDeliveryController@search_ready_center');
    Route::post('/update-ready-center', 'ReceiveDeliveryController@store_ready_center')->name('/update-ready-center');
    Route::get('/port-ready-center', 'ReceiveDeliveryController@port_ready_center');
    Route::get('/rappap-ready-center', 'ReceiveDeliveryController@rappap_ready_center');

    //ready center report
    Route::get('/foreign-ready-center-detail', 'ReceiveDeliveryController@foreign_ready_center_details');
    Route::get('/foreign-ready-summary', 'ReceiveDeliveryController@foreign_ready_center_summary');
    Route::get('/port-ready-center-details', 'ReceiveDeliveryController@port_ready_center_details');
    Route::get('/port-ready-center-summary', 'ReceiveDeliveryController@port_ready_center_summary');
    Route::get('/rappap-ready-center-details', 'ReceiveDeliveryController@rappap_ready_center_details');
    Route::get('/rappap-ready-center-summary', 'ReceiveDeliveryController@rappap_ready_center_summary');
    Route::post('foreign-ready-center-details-search', 'ReceiveDeliveryController@foreign_ready_center_details_search');
    Route::post('foreign-ready-center-summary-search', 'ReceiveDeliveryController@foreign_ready_center_summary_search');
    Route::post('port-ready-center-details-search', 'ReceiveDeliveryController@port_ready_center_details_search');
    Route::post('port-ready-center-summary-search', 'ReceiveDeliveryController@port_ready_center_summary_search');
    Route::post('rappap-ready-center-details-search', 'ReceiveDeliveryController@rappap_ready_center_details_search');
    Route::post('rappap-ready-center-summary-search', 'ReceiveDeliveryController@rappap_ready_center_summary_search');


    // passport revice center display page //
    Route::get('counter-call', 'CounterController@index');
    Route::get('/counter_call_get_data', 'CounterController@getData');
    Route::get('/operation/counter_call_get_data2', 'CounterController@getData');
    Route::get('/call_token_data_axios', 'CounterController@getTokenRegular');
    Route::get('/get_app_list_for_rcvd_by_webfile', 'CounterController@getAppListByWebfile');
    Route::get('/sll_api_check_payment', 'CounterController@getsslApiData');
    Route::get('/get_data_onload_axios', 'CounterController@getDataOnload');
    Route::get('/get_data_onload_editpass_axios', 'CounterController@getDataOnloadEditPass');
    Route::get('/reject-submit-axios', 'CounterController@rejectSubmit');
    Route::get('/visatype-check-axios', 'CounterController@VisaCheckList');
    Route::get('/webfile-data-save-axios', 'CounterController@webfileDataStore');
    Route::get('/send-token-to-waiting-axios', 'CounterController@TokenSentWaiting');
    Route::get('/send-token-to-recall-axios', 'CounterController@TokenSentRecall');
    Route::get('/pass-receive-print/{id}', 'CounterController@PassReceivePrint');
    Route::get('/readyat-center', 'CounterController@readAtCenter');
    Route::get('/onload-readyat-center-datas', 'CounterController@OnloadReadyatCenterData');
    Route::post('/ready-center-passport-datas', 'CounterController@readAtCenterStoreData');
    Route::get('/delivery-center', 'CounterController@DeliveryCenter');
    Route::get('/onload-delivery-center-datas', 'CounterController@OnloadDeliveryCenter');
    Route::post('/delivery-center-passport-datas', 'CounterController@deliveryCenterStoreData');
    Route::get('/check_valid_sticker_axios', 'CounterController@ValidStickerCheck');

    /// edit passport recive center //
    Route::get('/edit-receive-passport', 'CounterController@EditViewPassportReceive');
    Route::post('/edit-receive-passport', 'CounterController@EditPassportReceive');
    Route::get('/get_ttd_pass_edit_axios', 'CounterController@getTddEditPassRec');
    Route::post('/passport/receive/edit-store', 'CounterController@EditPassportReceiveUpdate');
    Route::get('/passport/receive/edit-destroy/{webNo}', 'CounterController@EditPassportReceiveDestroy');

    /// edit ready at center //
    Route::get('/ready-at-center-edit', 'CounterController@EditViewReadyCenter');
    Route::post('/ready-at-center-edit', 'CounterController@EditReadyCenter');
    Route::post('/ready-center/edit-store', 'CounterController@EditReadyCenterUpdate');
    Route::get('/ready-center/edit-destroy/{webNo}', 'CounterController@EditReadyCenterDestroy');

    /// edit delivery center //
    Route::get('/edit-delivery-center', 'CounterController@EditViewDeliveryCenter');
    Route::post('/edit-delivery-center', 'CounterController@EditDeliveryCenter');
    Route::post('/delivery-center/edit-store', 'CounterController@EditDeliveryCenterUpdate');
    Route::get('/delivery-center/edit-destroy/{webNo}', 'CounterController@EditDeliveryCenterDestroy');


    /// report ///
    Route::get('/passport-receive-summary-report', 'CounterController@PassReceiveSummReport');
    Route::post('/passport-receive-summary-report', 'CounterController@GetPassReceiveSummReport');

    Route::get('/passport-receive-details-report', 'CounterController@PassReceiveDetailsReport');
    Route::post('/passport-receive-details-report', 'CounterController@GetPassReceiveDetailsReport');


    Route::get('/ready-at-summary-report', 'CounterController@ReadyCenterSummReport');
    Route::post('/ready-at-summary-report', 'CounterController@GetReadyCenterSummReport');

    Route::get('/ready-at-center-details-report', 'CounterController@ReadyCenterDetailsReport');
    Route::post('/ready-at-center-details-report', 'CounterController@GetReadyCenterDetailsReport');

    Route::get('/readyat-center-failed-details-report', 'CounterController@ReadyCenterFailedDetailsReport');
    Route::post('/readyat-center-failed-details-report', 'CounterController@GetReadyCenterFailedDetailsReport');




    Route::get('/delivery-center-summary-report', 'CounterController@DeliveryCenterSummReport');
    Route::post('/delivery-center-summary-report', 'CounterController@GetDeliveryCenterSummReport');

    Route::get('/delivery-center-details-report', 'CounterController@DeliveryCenterDetailsReport');
    Route::post('/delivery-center-details-report', 'CounterController@GetDeliveryCenterDetailsReport');


    Route::get('/delivery-center-failed-details-report', 'CounterController@DeliveryCenterFailedDetailsReport');
    Route::post('/delivery-center-failed-details-report', 'CounterController@GetDeliveryCenterFailedDetailsReport');


///--------->> SETTING ////
  // center setup //
  Route::get('/setting/center-setup/create', 'ManageSettingController@centerSetupCreate');
  Route::post('/setting/center-setup/create', 'ManageSettingController@centerSetupUpdate');
  Route::get('/setting/queue-setup/create', 'ManageSettingController@queueSetupCreate');
  Route::post('/setting/queue-setup/create', 'ManageSettingController@queueSetupStore');
  Route::get('/setting/queue-setup/edit/{id}', 'ManageSettingController@queueSetupEdit');
  Route::post('/setting/queue-setup/update', 'ManageSettingController@queueSetupUpdate');
  Route::get('/setting/queue-setup/destroy/{id}', 'ManageSettingController@queueSetupDestroy');

  // counter setup //
  Route::get('/setting/counter-setup/create', 'ManageSettingController@counterSetupCreate');
  Route::post('setting/counter-setup/create', 'ManageSettingController@counterSetupStore');
  Route::get('/setting/counter-setup/edit/{id}', 'ManageSettingController@counterSetupEdit');
  Route::post('/setting/counter-setup/update', 'ManageSettingController@counterSetupUpdate');
  Route::get('/setting/counter-setup/destroy/{id}', 'ManageSettingController@counterSetupDestroy');



//// BRTA ////

Route::get('send_for_call_again','CounterController@PlayTokenAgain');


///// report -----//////
Route::get('counter-receive/details/report','CounterController@CounterReceiveDetailsReport');
Route::post('counter-receive/details/report','CounterController@CounterReceiveDetailsReportView');

Route::get('counter-receive/summary/report','CounterController@CounterReceiveSummaryReport');
Route::post('counter-receive/summary/report','CounterController@CounterReceiveSumaryReportView');

Route::get('counter-receive/user-wise/summary/report','CounterController@CounterUserWiseSummaryReport');
Route::post('counter-receive/user-wise/summary/report','CounterController@CounterUserWiseSumaryReportView');


//// ADMIN OPERATION /////
Route::get('operation/manage-queue','ManageSettingController@manageQueue');
Route::get('manage_queue_pending_token_axios','ManageSettingController@deletePendingToken');
Route::get('manage_queue_history_token_axios','ManageSettingController@deleteHistoryToken');
Route::get('manage_queue_issue_token_axios','ManageSettingController@SetIssueToken');
Route::get('manage_queue_create_token_axios','ManageSettingController@CreateTokenNumber');


Route::get('operation/queue-status','ManageSettingController@queueStatus');
Route::get('operation/search_token_info','ManageSettingController@searchTokenInfo');



});
