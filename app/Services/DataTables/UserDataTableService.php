<?php

namespace App\Services\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTableService extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->editColumn('profile_image', function ($query) {
                $url = $query->profile_image ? asset("uploads/img_profiles/$query->profile_image") : asset('images/error/no_image.png');
                return '<img src=' . $url . ' class="img-rounded" style="max-width: 100px" align="center"/>';
            })
            ->editColumn('gender', function ($query) {
                switch ($query->gender) {
                    case 'M':
                        return 'Male';
                        break;
                    case 'F':
                        return 'Female';
                }
            })
            ->filterColumn('gender', function ($query, $keyword) {
                $sql = 'CASE WHEN gender = "M" THEN "Male" 
                           WHEN gender = "F" THEN "Female" END like ?';
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('action', 'admin.user.action')
            ->rawColumns(['action', 'profile_image']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->where('role', '1')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
            ->orderBy(0, 'asc')
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('profile_image'),
            Column::make('name')->title('User Name'),
            Column::make('email'),
            Column::make('gender'),
            Column::make('birth_date'),
            Column::make('address'),
            Column::make('phone_number'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->width(60)
                ->addClass('text-center hide-search'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users' . date('YmdHis');
    }
}
