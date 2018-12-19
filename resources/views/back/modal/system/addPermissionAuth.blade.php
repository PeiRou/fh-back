<link rel="stylesheet" href="/vendor/zTree_v3/css/metroStyle/metroStyle.css">
<script type="text/javascript" src="/vendor/zTree_v3/js/jquery.ztree.core.min.js"></script>
<script type="text/javascript" src="/vendor/zTree_v3/js/jquery.ztree.excheck.js"></script>
<form id="addPermissionAuthForm" class="ui form" action="{{ route('system.addPermissionAuth') }}">
    <div class="field">
        <label>权限名称</label>
        <div class="ui input icon">
            <input type="text" name="auth_name" id="auth_name"/>
        </div>
    </div>
    <div class="field">
        <label>权限路由别名</label>
        <div class="ui input icon">
            <input type="text" name="route_name" id="route_name"/>
        </div>
    </div>
    <div class="field">
        <label>权限路由父级</label>
        <div class="ui input icon">
            <select class="ui dropdown" name="p_id" id="p_id" style='height:32px !important'>
                <option value="0">无父级</option>
                @foreach($aPermissionsAuths as $aPermissionsAuth)
                    <option value="{{ $aPermissionsAuth->id }}">--{{ $aPermissionsAuth->auth_name }}</option>
                    @if(!empty($aPermissionsAuth->child))
                        @foreach($aPermissionsAuth->child as $child)
                            <option value="{{ $child->id }}">  |__{{ $child->auth_name }}</option>
                        @endforeach
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="field">
        <label>类型</label>
        <div class="ui input icon">
            <select class="ui dropdown" name="type_id" id="type_id" style='height:32px !important'>
                @foreach($aPermissionsTypes as $aPermissionsType)
                    <option value="{{ $aPermissionsType->id }}">{{ $aPermissionsType->type_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="field">
        <label>是否存在下级</label>
        <div class="ui input icon">
            <select class="ui dropdown" name="open" id="open" style='height:32px !important'>
                <option value="0">没有</option>
                <option value="1">有</option>
            </select>
        </div>
    </div>
    <div class="field">
        <label>排序</label>
        <div class="ui input icon">
            <input type="text" name="sort" id="sort"/>
        </div>
    </div>
</form>
<script>
    $(function () {
        $('#addPermissionAuthForm').formValidation({
            framework: 'semantic',
            icon: {
                valid: 'checkmark icon',
                invalid: 'remove icon',
                validating: 'refresh icon'
            },
            fields: {
                auth_name: {
                    validators: {
                        notEmpty: {
                            message: '请输入权限名称'
                        }
                    }
                },
                route_name: {
                    validators: {
                        notEmpty: {
                            message: '请输入权限别名称'
                        }
                    }
                },
                type_id: {
                    validators: {
                        notEmpty: {
                            message: '请选择类型'
                        }
                    }
                }
            }
        }).on('success.form.fv', function (e) {
            e.preventDefault();
            var $form = $(e.target),
                fv = $form.data('formValidation');
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function (result) {
                    if(result.status == true){
                        jc1.close();
                        $('#example').DataTable().ajax.reload(null,false);
                    }
                }
            });
        });
    });
</script>