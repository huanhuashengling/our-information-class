@extends('layouts.admin')

@section('content')
<div class="container">
    <div id="toolbar">
        <button class="btn btn-success" id="add-send-mail-btn">新增发件箱</button>
    </div>
    <table id="send-mail-list" class="table table-condensed table-responsive">
        <thead>
            <tr>
                <th data-field="" checkbox="true">

                </th>
                <th data-field="">
                    序号
                </th>
                <th data-field="server_provider" data-sortable="true">
                    邮箱服务
                </th>
                <th data-field="num_limit_one_day" data-sortable="true">
                    每天上限
                </th>
                <th data-field="username" data-sortable="true">
                    用户名
                </th>
                <th data-field="mail_address" data-sortable="true">
                    邮箱地址
                </th>
                <th data-field="password" data-sortable="true">
                    密码
                </th>
                <th data-field="auth_code" data-sortable="true">
                    授权码
                </th>
                <th data-field="is_useable" data-sortable="true">
                    是否可用
                </th>
                <th data-field="lessonsId" data-formatter="actionCol" data-events="actionEvents">
                  操作
                </th>
            </tr>
        </thead>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="add-send-mail-modal" tabindex="-2" role="dialog" aria-labelledby="lesson-detail-modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">新增邮箱地址</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal">
              <div class="form-group">
                <label for="server-provider" class="col-sm-2 control-label">邮箱服务</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="server-provider" required placeholder="QQ, 126, 163" value="126">
                </div>
              </div>
              <div class="form-group">
                <label for="num-limit-one-day" class="col-sm-2 control-label">次数限制</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="num-limit-one-day" required placeholder="3" value=3>
                </div>
              </div>
              <div class="form-group">
                <label for="username" class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="username" required placeholder="邮箱地址">
                </div>
              </div>
              <div class="form-group">
                <label for="mail-address" class="col-sm-2 control-label">邮箱地址</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="mail-address" required placeholder="邮箱地址">
                </div>
              </div>
              <div class="form-group">
                <label for="password" class="col-sm-2 control-label">密码</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="password" required placeholder="密码">
                </div>
              </div>
              <div class="form-group">
                <label for="auth-code" class="col-sm-2 control-label">授权码</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="auth-code" required placeholder="授权码">
                </div>
              </div>
              <div class="form-group">
                <label for="is-useable" class="col-sm-2 control-label">是否可用</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="is-useable" required placeholder="0不可用，1可用" value=1>
                </div>
              </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="add-send-mail">新增</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="edit-send-mail-modal" tabindex="-2" role="dialog" aria-labelledby="lesson-detail-modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">修改邮箱地址</h4>
          </div>
          <div class="modal-body">
            <input type="hidden" name="" id="send-mail-id">
            <form class="form-horizontal">
              <div class="form-group">
                <label for="server-provider" class="col-sm-2 control-label">邮箱服务</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="edit-server-provider" required value="126">
                </div>
              </div>
              <div class="form-group">
                <label for="num-limit-one-day" class="col-sm-2 control-label">次数限制</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="edit-num-limit-one-day" required value=3>
                </div>
              </div>
              <div class="form-group">
                <label for="username" class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="edit-username" required>
                </div>
              </div>
              <div class="form-group">
                <label for="mail-address" class="col-sm-2 control-label">邮箱地址</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="edit-mail-address" required>
                </div>
              </div>
              <div class="form-group">
                <label for="password" class="col-sm-2 control-label">密码</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="edit-password" required>
                </div>
              </div>
              <div class="form-group">
                <label for="auth-code" class="col-sm-2 control-label">授权码</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="edit-auth-code" required>
                </div>
              </div>
              <div class="form-group">
                <label for="is-useable" class="col-sm-2 control-label">是否可用</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="edit-is-useable" required placeholder="0不可用，1可用" value=1>
                </div>
              </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="edit-send-mail">修改</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="/js/school/send-mail.js"></script>
@endsection