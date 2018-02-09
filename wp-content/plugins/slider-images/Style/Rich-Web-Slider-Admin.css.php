<?php
	if(!current_user_can('manage_options'))
	{
		die('Access Denied');
	}
?>
<style type='text/css'>
	.JAddSlider { position: absolute; right: 10px; bottom: 10px; padding: 5px 10px;	background: #47bde5; cursor: pointer; border: none; box-shadow: 0px 0px 2px #47bde5; color: #fff; text-shadow:1px 1px 1px #000000; width:100px; height:30px; transition:all 0.3s linear; }
	.JAddSliderAnim { width:0px !important; padding:0px !important; transition:all 0s linear; }
	.JSaveSlider, .JUpdateSlider, .JCanselSlider { position: absolute; right: 10px; bottom: 10px; padding: 0px; background: #47bde5; cursor: pointer; border: none; box-shadow: 0px 0px 2px #47bde5; color: #fff; text-shadow:1px 1px 1px #000000; width:0px; height:30px; transition:all 0.3s linear; }
	.JSaveSliderAnim { padding: 5px 10px !important; width:100px !important; right:120px !important; transition:all 0s linear; }
	.JSaveSlider:hover, .JCanselSlider:hover, .JUpdateSlider:hover, .JAddSlider:hover { color: #fff; background:#30a9d1; box-shadow: 0px 0px 2px #30a9d1; }
	.JCanselSliderAnim { padding: 5px 10px !important; width:100px !important; transition:all 0s linear; }	
	.Table_Data_rich_web_Content { position:relative; width:99%; }
	.Table_Data_rich_web1 { position:absolute; top:0%; left:0%; width:100% !important; margin-top:10px; z-index:1; }	
	.rich_web_Tit_Table { width: 100%; background-color: #fff; text-align: center; text-shadow:1px 1px 1px #000000; padding: 1px; color: #fff; }
	.rich_web_Tit_Table_Tr { background:#30a9d1; }
	.rich_web_Tit_Table td:nth-child(1) { width:10%; }
	.rich_web_Tit_Table td:nth-child(2) { width:25%; }
	.rich_web_Tit_Table td:nth-child(3) { width:25%; }
	.rich_web_Tit_Table td:nth-child(4) { width:10%; }
	.rich_web_Tit_Table td:nth-child(5) { width:30%; }
	.rich_web_Tit_Table2 { width: 100%; background-color: #fff; margin-top:10px; text-align: center; text-shadow:0px 0px 0px #000000; padding: 1px; color: #34383c; }
	.rich_web_Tit_Table_Tr2 { background:#f1f1f1; }
	.rich_web_Tit_Table_Tr2:nth-child(even) { background:#ffffff; }
	.rich_web_Tit_Table_Tr2:hover { background:#e9e9e9; }
	.rich_web_Tit_Table2 td:nth-child(1) { width:10%; }
	.rich_web_Tit_Table2 td:nth-child(2) { width:25%; }
	.rich_web_Tit_Table2 td:nth-child(3) { width:25%; }
	.rich_web_Tit_Table2 td:nth-child(4) { width:10%; }
	.rich_web_Tit_Table2 td:nth-child(5) { width:10%; cursor:pointer; }
	.rich_web_Tit_Table2 td:nth-child(6) { width:10%; cursor:pointer; }
	.rich_web_Tit_Table2 td:nth-child(7) { width:10%; cursor:pointer; }
	.jIcPencil { color:#ff0000; }
	.jIcDel { color:#00a0d2; }
	.jIcFileso { color: #02b424; }
	#JShortcode { width:99%; margin-top:10px; display:none; }
	.rich_web_ShortTable { position:relative;	width: 28%;	padding: 1px; background-color: white; text-align: justify; color: #000; font-size: 12px; }
	.rich_web_ShortTable tr td { padding:5px; text-align:center; }
	.rich_web_ShortTable tr:nth-child(1) { background-color: #30a9d1; color: #ffffff; }
	.rich_web_ShortTable tr:nth-child(2) { background-color: #f1f1f1; }
	.rich_web_ShortTable tr:nth-child(3) { background-color: #f1f1f1; }
	.rich_web_ShortTable tr:nth-child(4) { background-color: #30a9d1; color: #ffffff; }
	.rich_web_ShortTable tr:nth-child(5) { background-color: #f1f1f1; }
	.rich_web_ShortTable tr:nth-child(6) { background-color: #f1f1f1; }
	.Table_Data_rich_web2 { position:absolute; top:0%; left:0%; width:100% !important; margin-top:10px; z-index:1; display:none; }
	.rich_web_SaveSl_Table { position:relative; width: 70%; padding: 1px; background-color: #fff; text-align: center; color: #000; font-size: 12px; margin-bottom:15px; }
	.rich_web_SaveSl_Table tr { background:#f1f1f1; }
	.rich_web_SaveSl_Table tr:nth-child(even) { background:#ffffff; }
	.rich_web_SaveSl_Table tr td { padding:3px; font-size:12px; font-family:Arial; }	
	.JSlInput {	width:100%; max-width:400px; font-size:12px; }
	.addImJ { background:#30a9d1; color:#fff; text-shadow:1px 1px 1px #000; }	
	.jChB { margin-left:10px !important; }
	.JSVBut, .JRBut, .JUPBut { padding: 5px 10px; background: #fff; cursor: pointer; border: none; color: #000; transition: all 0.3s linear; font-size:10px; margin:10px; }
	.JSVBut:hover, .JRBut:hover, .JUPBut:hover { color: #fff; background: #30a9d1; text-shadow: 0px 0px 2px #fff; }
	.JUPBut { display:none; }
	.rich_web_SaveSl_Table2 { position:relative; width: 100%; padding: 1px; background-color: #fff; text-align: center; color: #000; font-size: 12px; margin-bottom:15px; }
	.rich_web_SaveSl_Table2 tr { background:#30a9d1; }
	.rich_web_SaveSl_Table2 tr td { color:#fff; text-shadow:2px 2px 2px #000000; }
	.rich_web_SaveSl_Table2 tr td:nth-child(1) { width:5%; }
	.rich_web_SaveSl_Table2 tr td:nth-child(2) { width:25%; }
	.rich_web_SaveSl_Table2 tr td:nth-child(3) { width:40%; }
	.rich_web_SaveSl_Table2 tr td:nth-child(4) { width:15%; }
	.rich_web_SaveSl_Table2 tr td:nth-child(5) { width:15%; }
	.rich_web_SaveSl_Table3 { position:relative; width: 100%; padding: 1px; background-color: #fff; text-align: center; color: #000; font-size: 12px; margin-bottom:15px; }
	.rich_web_SaveSl_Table3 tr { background:#f1f1f1; }
	.rich_web_SaveSl_Table3 tr td { padding:5px; }
	.rich_web_SaveSl_Table3 tr:nth-child(even) { background:#ffffff; }
	.rich_web_SaveSl_Table3 tr:hover { background:#e9e9e9; cursor: all-scroll; }
	.rich_web_SaveSl_Table3 tr td:nth-child(1) { width:5%; }
	.rich_web_SaveSl_Table3 tr td:nth-child(2) { width:25%; }
	.rich_web_SaveSl_Table3 tr td:nth-child(3) { width:40%; }
	.rich_web_SaveSl_Table3 tr td:nth-child(4) { width:15%; position: relative; cursor: pointer; }
	.rich_web_SaveSl_Table3 tr td:nth-child(5) { width:15%; position: relative; cursor: pointer; }
	.rich_web_SaveSl_Table3 i { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
	.rich_web_SaveSl_Table3 i:before { display: block; position: relative; top: 50%; transform: translateY(-50%); -webkit-transform: translateY(-50%); }
	.JAddSrc { height:10%; max-width:100%; }

	.Rich_Web_SliderIm_Fixed_Div { position: fixed; left: 0; top: 0; width: 100%; height: 100%; z-index: 999999999999; background: rgba(0, 0, 0, 0.2); display: none; }
	.Rich_Web_SliderIm_Absolute_Div { position: fixed; width: 100%; z-index: 9999999999999; top: 50%; transform: translateY(-50%); left: 0; text-align: center; display: none; }
	.Rich_Web_SliderIm_Relative_Div { position: relative; background: #47bde5; margin: 0 auto; padding: 5px 10px; color: #ffffff; border: 2px solid #ffffff; float: left; left: 50%; transform: translateX(-50%); text-shadow: 1px 1px 1px #000000; }
	.Rich_Web_SliderIm_Relative_Div p { font-size: 16px; width: 100%; }
	.Rich_Web_SliderIm_Relative_Div span { position: relative; float: right; margin: 5px 10px; padding: 5px 10px; background: #ffffff; color: #47bde5; cursor: pointer; border: 1px solid #ffffff; border-radius: 5px; text-shadow: none; }
	.Rich_Web_SliderIm_Relative_Div span:hover { color: #ffffff; background: #30a9d1; text-shadow: 1px 1px 1px #000000; }
	@media all and (max-width:410px) { .rich_web_SaveSl_Table { width:61%; } }	
</style>