<?php
	if(!current_user_can('manage_options'))
	{
		die('Access Denied');
	}
?>
<style type='text/css'>
	.range-slider { width: 100%; }
	.range-slider__range { -webkit-appearance: none; width: calc(100% - (130px)); height: 10px; border-radius: 5px; background: #d7dcdf; outline: none; padding: 0; margin: 0; }
	.range-slider__range::-webkit-slider-thumb { -webkit-appearance: none; appearance: none; width: 20px; height: 20px; border-radius: 50%; background: #2c3e50; cursor: pointer; -webkit-transition: background .15s ease-in-out; transition: background .15s ease-in-out; }
	.range-slider__range::-webkit-slider-thumb:hover { background: #23282d; }
	.range-slider__range:active::-webkit-slider-thumb { background: #23282d; }
	.range-slider__range::-moz-range-thumb { width: 20px; height: 20px; border: 0; border-radius: 50%; background: #2c3e50; cursor: pointer; -webkit-transition: background .15s ease-in-out; transition: background .15s ease-in-out; }
	.range-slider__range::-moz-range-thumb:hover { background: #23282d; }
	.range-slider__range:active::-moz-range-thumb { background: #23282d; }
	.range-slider__value { display: inline-block; position: relative; color: #ffffff; line-height: 20px; text-align: center; border-radius: 3px; background: #2c3e50; padding: 5px 15px; margin-left: 8px; }
	.range-slider__value:after { position: absolute; top: 8px; left: -7px; width: 0; height: 0; border-top: 7px solid transparent; border-right: 7px solid #2c3e50; border-bottom: 7px solid transparent; content: ''; }
	::-moz-range-track { background: #d7dcdf; border: 0; }
	input::-moz-focus-inner, input::-moz-focus-outer { border: 0; }
	.switch { position: relative; display: block; vertical-align: top; width: 80px; height: 25px; padding: 3px; margin:auto; margin-top: -3px; background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px); background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px); border-radius: 18px; box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05); cursor: pointer; }
	.switch-input { position: absolute; top: 0; left: 0; opacity: 0; }
	.switch-label { position: relative; display: block; height: inherit; font-size: 10px; text-transform: uppercase; background: #ff0000; border-radius: inherit; box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15); }
	.switch-label:before, .switch-label:after { position: absolute; top: 50%; margin-top: -.5em; line-height: 1; -webkit-transition: inherit; -moz-transition: inherit; -o-transition: inherit; transition: inherit; }
	.switch-label:before { content: attr(data-off); right: 11px; color: #ff0000; }
	.switch-label:after { content: attr(data-on); left: 11px; color: #FFFFFF; opacity: 0; }
	.switch-input:checked ~ .switch-label { background: #E1B42B; }
	.switch-input:checked ~ .switch-label:before { opacity: 0; }
	.switch-input:checked ~ .switch-label:after { opacity: 1; }
	.switch-handle { position: absolute; top: 4px; left: 4px; width: 28px; height: 28px; background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0); background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0); border-radius: 100%; box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2); }
	.switch-handle:before { content: ""; position: absolute; top: 50%; left: 50%; margin: -6px 0 0 -6px; width: 12px; height: 12px; background: linear-gradient(to bottom, #eeeeee, #FFFFFF); background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF); border-radius: 6px; box-shadow: inset 0 1px rgba(0, 0, 0, 0.02); }
	.switch-input:checked ~ .switch-handle { left: 74px; box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2); }
	/* Switch Light ==========================*/
	.switch-light {	padding: 0; background: #FFF; background-image: none; }
	.switch-light .switch-label { background: #FFF; border: solid 2px #ff0000; box-shadow: none; }
	.switch-light .switch-label:after { color: #79e271; }
	.switch-light .switch-label:before { right: inherit; left: 11px; }
	.switch-light .switch-handle { top: 5px; left: 55px; background: #ff0000; width: 20px; height: 20px; box-shadow: none; }
	.switch-light .switch-handle:before { background: #fe8686; }
	.switch-light .switch-input:checked ~ .switch-label { background: #FFF;	border-color: #79e271; }
	.switch-light .switch-input:checked ~ .switch-handle { left: 55px; box-shadow: none; background: #79e271 }
	.switch-light .switch-input:checked ~ .switch-handle:before { background: rgba(255,255,255,0.7); }
	/* Transition ============================================================ */
	.switch-label, .switch-handle { transition: All 0.3s ease; -webkit-transition: All 0.3s ease; -moz-transition: All 0.3s ease; -o-transition: All 0.3s ease; }
	.jIcPencil { color:#ff0000; }
	.jIcDel { color:#00a0d2; }
	.jIcFileso { color: #02b424; }
	.Table_Data_rich_web_Content_2 { position:relative;	width:99%; }
	.Table_Data_rich_web1_2 { position:absolute; top:0%; left:0%; width:100% !important; margin-top:10px; z-index:1; }	
	.rich_web_Tit_Table_2 { width: 100%; background-color: #fff; text-align: center; text-shadow:1px 1px 1px #000000; padding: 1px; color: #fff; }
	.rich_web_Tit_Table_2_Tr { background:#30a9d1; }
	.rich_web_Tit_Table_2 td:nth-child(1) { width:10%; }
	.rich_web_Tit_Table_2 td:nth-child(2) { width:30%; }
	.rich_web_Tit_Table_2 td:nth-child(3) { width:30%; }
	.rich_web_Tit_Table_2 td:nth-child(4) {	width:30%; }
	.rich_web_Tit_Table2_2 { width: 100%; background-color: #fff; margin-top:10px; text-align: center; text-shadow:0px 0px 0px #000000; padding: 1px; color: #34383c; margin-bottom: 100px; }
	.rich_web_Tit_Table2_2_Tr2 { background:#f1f1f1; }
	.rich_web_Tit_Table2_2_Tr2:nth-child(even) { background:#ffffff; }
	.rich_web_Tit_Table2_2_Tr2:hover { background:#e9e9e9; }
	.rich_web_Tit_Table2_2 td:nth-child(1) { width:10%; }
	.rich_web_Tit_Table2_2 td:nth-child(2) { width:30%; }
	.rich_web_Tit_Table2_2 td:nth-child(3) { width:30%; }
	.rich_web_Tit_Table2_2 td:nth-child(4) { width:10%; cursor:pointer; }
	.rich_web_Tit_Table2_2 td:nth-child(5) { width:10%; cursor:pointer;	}
	.rich_web_Tit_Table2_2 td:nth-child(6) { width:10%; cursor:pointer;	}
	.JAddSlider2 { position: absolute; right: 10px; bottom: 10px; padding: 5px 10px; background: #47bde5; cursor: pointer; border: none; box-shadow: 0px 0px 2px #47bde5; color: #fff; text-shadow:1px 1px 1px #000000; width: initial !important; height:30px; transition:all 0.3s linear; }
	.JAddSlider2Anim { width:0px !important; padding:0px !important; transition:all 0s linear; }
	.JSaveSlider2, .JCanselSlider2, .JUpdateSlider2 { position: absolute; right: 10px; bottom: 10px; padding: 0px; background: #47bde5; cursor: pointer; border: none; box-shadow: 0px 0px 2px #47bde5; color: #fff; text-shadow:1px 1px 1px #000000; width:0px; height:30px; transition:all 0.3s linear; }
	.JSaveSlider2Anim { padding: 5px 10px !important; width: initial !important; right:80px !important; transition:all 0s linear; }
	.JAddSlider2:hover, .JSaveSlider2:hover, .JCanselSlider2:hover, .JUpdateSlider2:hover { color: #fff; background:#30a9d1; box-shadow: 0px 0px 2px #30a9d1; }
	.JCanselSlider2Anim { padding: 5px 10px !important; width: initial !important; transition:all 0s linear; }	
	.Table_Data_rich_web2_2 { position:absolute; top:0%; left:0%; width:100% !important; margin-top:10px; z-index:1; display:none; }
	.rich_web_SaveSl_Table, .rich_web_SaveSl_Table_2 { position:relative; width: 100%; padding: 1px; background-color: #fff; text-align: center; color: #000; font-size: 12px; margin-bottom:15px; }
	.rich_web_SaveSl_Table_2 tr, .rich_web_SaveSl_Table tr { background:#f1f1f1; height: 35px; }
	.rich_web_SaveSl_Table_2 tr:nth-child(even), .rich_web_SaveSl_Table tr:nth-child(even) { background:#ffffff; }
	.rich_web_SaveSl_Table_2 tr td { width: 25%; }
	.rich_web_SaveSl_Table tr td, .rich_web_Text_Field { width: 50%; }
	.rich_web_Select_Menu { width: 70%; }
	.Rich_Web_SliderIm_Fixed_Div { position: fixed; left: 0; top: 0; width: 100%; height: 100%; z-index: 999999999999; background: rgba(0, 0, 0, 0.2); display: none; }
	.Rich_Web_SliderIm_Absolute_Div { position: fixed; width: 100%; z-index: 9999999999999; top: 50%; transform: translateY(-50%); left: 0; text-align: center; display: none; }
	.Rich_Web_SliderIm_Relative_Div { position: relative; background: #47bde5; margin: 0 auto; padding: 5px 10px; color: #ffffff; border: 2px solid #ffffff; float: left; left: 50%; transform: translateX(-50%); text-shadow: 1px 1px 1px #000000; }
	.Rich_Web_SliderIm_Relative_Div p { font-size: 16px; width: 100%; }
	.Rich_Web_SliderIm_Relative_Div span { position: relative; float: right; margin: 5px 10px; padding: 5px 10px; background: #ffffff; color: #47bde5; cursor: pointer; border: 1px solid #ffffff; border-radius: 5px; text-shadow: none; }
	.Rich_Web_SliderIm_Relative_Div span:hover { color: #ffffff; background: #30a9d1; text-shadow: 1px 1px 1px #000000; }	
	.Rich_Web_SliderIm_Pro { font-weight: 900; color: #ff0000; font-size: 14px; margin-left: 5px; cursor: default; }
	
	/*Loading*/

	.rw_loading_c{ position: fixed; top: 0; left: 0; width: 100%; height: 100%; background:rgba(0,0,0,0.5); z-index:999999; }
	.cont_cont{ position: relative; top: 50%; transform:translateY(-50%); -webkit-transform:translateY(-50%); -ms-transform:translateY(-50%); -moz-transform:translateY(-50%); -o-transform:translateY(-50%); }
	.cssload-thecube{ width: 50px !important; height: 50px !important; }
	.cssload-thecube{ width: 50px; height: 50px; margin: 20px auto; position: relative; transform: rotateZ(45deg); -o-transform: rotateZ(45deg); -ms-transform: rotateZ(45deg); -webkit-transform: rotateZ(45deg); -moz-transform: rotateZ(45deg); }
	.cssload-thecube .cssload-cube { position: relative; transform: rotateZ(45deg); -o-transform: rotateZ(45deg); -ms-transform: rotateZ(45deg); -webkit-transform: rotateZ(45deg); -moz-transform: rotateZ(45deg); }
	.cssload-thecube .cssload-cube { float: left; width: 50%; height: 50%; position: relative; transform: scale(1.1); -o-transform: scale(1.1); -ms-transform: scale(1.1); -webkit-transform: scale(1.1); -moz-transform: scale(1.1); }
	.cssload-thecube .cssload-cube:before { content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: #6ecae9; animation: cssload-fold-thecube 2.76s infinite linear both; -o-animation: cssload-fold-thecube 2.76s infinite linear both; -ms-animation: cssload-fold-thecube 2.76s infinite linear both; -webkit-animation: cssload-fold-thecube 2.76s infinite linear both; -moz-animation: cssload-fold-thecube 2.76s infinite linear both; transform-origin: 100% 100%; -o-transform-origin: 100% 100%; -ms-transform-origin: 100% 100%; -webkit-transform-origin: 100% 100%; -moz-transform-origin: 100% 100%; }
	.cssload-thecube .cssload-c2 { transform: scale(1.1) rotateZ(90deg); -o-transform: scale(1.1) rotateZ(90deg); -ms-transform: scale(1.1) rotateZ(90deg); -webkit-transform: scale(1.1) rotateZ(90deg); -moz-transform: scale(1.1) rotateZ(90deg); }
	.cssload-thecube .cssload-c3 { transform: scale(1.1) rotateZ(180deg); -o-transform: scale(1.1) rotateZ(180deg); -ms-transform: scale(1.1) rotateZ(180deg); -webkit-transform: scale(1.1) rotateZ(180deg); -moz-transform: scale(1.1) rotateZ(180deg); }
	.cssload-thecube .cssload-c4 { transform: scale(1.1) rotateZ(270deg); -o-transform: scale(1.1) rotateZ(270deg); -ms-transform: scale(1.1) rotateZ(270deg); -webkit-transform: scale(1.1) rotateZ(270deg); -moz-transform: scale(1.1) rotateZ(270deg); }
	.cssload-thecube .cssload-c2:before { animation-delay: 0.35s; -o-animation-delay: 0.35s; -ms-animation-delay: 0.35s; -webkit-animation-delay: 0.35s; -moz-animation-delay: 0.35s; }
	.cssload-thecube .cssload-c3:before { animation-delay: 0.69s; -o-animation-delay: 0.69s; -ms-animation-delay: 0.69s; -webkit-animation-delay: 0.69s; -moz-animation-delay: 0.69s; }
	.cssload-thecube .cssload-c4:before { animation-delay: 1.04s; -o-animation-delay: 1.04s; -ms-animation-delay: 1.04s; -webkit-animation-delay: 1.04s; -moz-animation-delay: 1.04s; }
	@keyframes cssload-fold-thecube { 0%, 10% { transform: perspective(136px) rotateX(-180deg); opacity: 0; } 25%, 75% { transform: perspective(136px) rotateX(0deg); opacity: 1; } 90%, 100% { transform: perspective(136px) rotateY(180deg); opacity: 0; } }
	@-o-keyframes cssload-fold-thecube { 0%, 10% { -o-transform: perspective(136px) rotateX(-180deg); opacity: 0; } 25%, 75% { -o-transform: perspective(136px) rotateX(0deg); opacity: 1; } 90%, 100% { -o-transform: perspective(136px) rotateY(180deg); opacity: 0; } }
	@-ms-keyframes cssload-fold-thecube { 0%, 10% { -ms-transform: perspective(136px) rotateX(-180deg); opacity: 0; } 25%, 75% { -ms-transform: perspective(136px) rotateX(0deg); opacity: 1; } 90%, 100% { -ms-transform: perspective(136px) rotateY(180deg); opacity: 0; } }
	@-webkit-keyframes cssload-fold-thecube { 0%, 10% { -webkit-transform: perspective(136px) rotateX(-180deg); opacity: 0; } 25%, 75% { -webkit-transform: perspective(136px) rotateX(0deg); opacity: 1; } 90%, 100% { -webkit-transform: perspective(136px) rotateY(180deg); opacity: 0; } }
	@-moz-keyframes cssload-fold-thecube { 0%, 10% { -moz-transform: perspective(136px) rotateX(-180deg); opacity: 0; } 25%, 75% { -moz-transform: perspective(136px) rotateX(0deg); opacity: 1; } 90%, 100% { -moz-transform: perspective(136px) rotateY(180deg); opacity: 0; } }
	.RW_Loader_Text_Navigation{ position:relative; text-align:center; margin-top:10px; font-size: 18px !important; font-family:Arial !important; color: #6ecae9 !important; }
</style>