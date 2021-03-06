<div class="panel panel-default">
    <div class="panel-body">

        {* tpl default/com_headsearch plugin=users.users action=default.list search=users.user_name *}

        <br>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>
                        <a href="{* raw order.user_name *}">{* lang users.user_name *}</a> {* raw arrow.user_name *}
                    </th>
                    <th>
                        <a href="{* raw order.user_since *}">{* lang default.since *}</a> {* raw arrow.user_since *}
                    </th>
                    <th>
                        <a href="{* raw order.user_laston *}">{* lang users.laston *}</a> {* raw arrow.user_laston *}
                    </th>
                </tr>
            </thead><!--END table thead-->

            <tbody>
                {* foreach users *}
                <tr>
                    <td>
                        <a href="{* link users/view/id/$users.user_id *}">{* var users.user_name *}</a>
                    </td>
                    <td>
                        {* date users.user_since *}
                    </td>
                    <td>
                        {* date users.user_laston *}
                    </td>
                </tr>
                {* else users *}
                <tr>
                    <th class="text-center" colspan="3">
                        {* lang default.no_record_found *}
                    </th>
                </tr>
                {* endforeach users *}
            </tbody><!--END table tbody-->
        </table><!--END table-->

        {* raw pages *}

    </div><!--END panel-body-->
</div><!--END panel-->
