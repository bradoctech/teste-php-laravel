<style>
    td {
        text-overflow: ellipsis;
        overflow-x: auto;
    }
</style>
<div class="modal fade" id="modalError" tabindex="-1" aria-labelledby="modalErrorLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalErrorLabel">Erros</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table table-responsive-xxl">
                    <thead>
                    <tr>
                        <th scope="col"><div>Id</div></th>
                        <th scope="col"><div>Uuid</div></th>
                        <th scope="col"><div>Connection</div></th>
                        <th scope="col"><div>Queue</div></th>
                        <th scope="col"><div>Data</div></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($errors as $model)
                        <tr>
                            <td><div>{{$model->id}}</div></td>
                            <td><div>{{$model->uuid}}</div></td>
                            <td><div>{{$model->connection}}</div></td>
                            <td><div>{{$model->queue}}</div></td>
                            <td><div>{{$model->uuid}}</div></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                </button>
            </div>
        </div>
    </div>
</div>
