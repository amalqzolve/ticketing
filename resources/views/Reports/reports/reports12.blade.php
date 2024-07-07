@extends('Reports.common.layout')
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('/')}}/public/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/public/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/public/easyui/demo/demo.css">
    <script type="text/javascript" src="{{url('/')}}/public/easyui/jquery.min.js"></script>
	<script type="text/javascript" src="{{url('/')}}/public/easyui/jquery.easyui.min.js"></script>


<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mb-5">
	<br />
	<div class="kt-portlet kt-portlet--mobile">
        <div class="container-fluid">
            <div class="row  border border-top-0 border-left-0 border-toright-0 pt-3 pb-3" >
                <div class="col-md-12">
                    <h3>Heading</h3>
                </div>
            </div>
            <div class="row pt-4 pb-4">
                <div class="col-12">




                <div style="margin:20px 0;">
                    <input type="button" onclick="exportExcel()" value="Export to Excel " />
                </div>

                <table id="tg" class="easyui-treegrid" title="TreeGrid Actions" style="width:100%;height:250px"
                        data-options="
                            iconCls: 'icon-ok',
                            rownumbers: true,
                            animate: true,
                            collapsible: true,
                            fitColumns: true,
                            url: '{{url("/")}}/public/easyui/demo/treegrid/treegrid_data2.json',
                            method: 'get',
                            idField: 'id',
                            treeField: 'name',
                            pagination: true,
                            showFooter: true,
                        ">
                    <thead>
                        <tr>
                            <th data-options="field:'name',width:180">Task Name</th>
                            <th data-options="field:'persons',width:60,align:'right'">Persons</th>
                            <th data-options="field:'begin',width:80">Begin Date</th>
                            <th data-options="field:'end',width:80">End Date</th>
                            <th data-options="field:'progress',width:120,formatter:formatProgress">Progress</th>
                        </tr>
                    </thead>
                </table>

                <script type="text/javascript">
                    function formatProgress(value){
                        if (value){
                            var s = '<div style="width:100%;border:1px solid #ccc">' +
                                    '<div style="width:' + value + '%;background:#cc0000;color:#fff">' + value + '%' + '</div>'
                                    '</div>';
                            return s;
                        } else {
                            return '';
                        }
                    }
                    function collapseAll(){
                        $('#tg').treegrid('collapseAll');
                    }
                    function expandAll(){
                        $('#tg').treegrid('expandAll');
                    }
                    function expandTo(){
                        $('#tg').treegrid('expandTo',21).treegrid('select',21);
                    }


                    function exportExcel() {
                        $('#tg').datagrid('toExcel','dg.xls');
                    }
                </script>

                </div>
            </div>
        </div>

	    </div>


	</div>
</div>


<!-- <script src="{{url('/')}}/resources/js/resourcemanagement/department.js" type="text/javascript"></script> -->
@endsection
