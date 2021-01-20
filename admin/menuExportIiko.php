<?php
set_time_limit(0);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
CJSCore::Init(array("jquery"));
$APPLICATION->AddHeadScript('/bitrix/js/iiko.integration/menuExportIiko.js');

$POST_RIGHT = $APPLICATION->GetGroupRight("main");
if ($POST_RIGHT == "D") {
    $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));
}
$aTabs = array(array("DIV" => "edit1", "TAB" => "Экспорт меню"));
$tabControl = new CAdminTabControl("tabControl", $aTabs);
$APPLICATION->SetTitle("Экспорт меню Iiko");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");?>
<form method="post" action="<?echo $APPLICATION->GetCurPage()?>" enctype="multipart/form-data" name="post_form" id="post_form">
<?
$tabControl->Begin();
$tabControl->BeginNextTab();
?>
    <tr>
        <td colspan="2">
            <input type=button value="Старт" id="work_start" />
            <div id="progress" style="display:none;" width="100%">
            <br />
                <table border="0" cellspacing="0" cellpadding="2" width="100%">
                    <tr>
                        <td height="10">
                            <div style="border:1px solid #B9CBDF">
                                <div id="indicator" style="height:10px; width:0%; background-color:#B9CBDF"></div>
                            </div>
                        </td>
                        <td width=30>&nbsp;<span id="percent">0%</span></td>
                    </tr>
                </table>
            </div>
            <div id="result" style="padding-top:10px"></div>
        </td>
    </tr>
<?
$tabControl->End();
?>
</form>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");?>