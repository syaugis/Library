<?php

namespace App\Services\DataTables;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LoanDataTableService extends DataTable
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
            ->editColumn('status', function ($query) {
                switch ($query->status) {
                    case '0':
                        return '<span class="text-capitalize badge bg-primary mb-2"> Pending </span>';
                        break;
                    case '1':
                        return '<span class="text-capitalize badge bg-info mb-2"> Approved and Loaned </span>';
                        break;
                    case '2':
                        return '<span class="text-capitalize badge bg-warning mb-2"> Exceed Limit Day </span>';
                        break;
                    case '3':
                        return '<span class="text-capitalize badge bg-danger mb-2"> Rejected </span>';
                        break;
                    case '4':
                        return '<span class="text-capitalize badge bg-success mb-2"> Returned </span>';
                        break;
                }
            })
            ->filterColumn('status', function ($query, $keyword) {
                $sql = 'CASE WHEN status = 0 THEN "Pending" 
                           WHEN status = 1 THEN "Approved and Loaned"
                           WHEN status = 2 THEN "Exceed Limit Day"
                           WHEN status = 3 THEN "Rejected"
                           WHEN status = 4 THEN "Returned" END like ?';
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('action', 'admin.loan.action')
            ->rawColumns(['action', 'status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Loan $model): QueryBuilder
    {
        return $model->newQuery()
            ->with(['user', 'bookCopy.book'])
            ->select('loans.*');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('loans-table')
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
            Column::make('bookCopy.book.title')->data('book_copy.book.title')->title('Book Title'),
            Column::make('user.name')->data('user.name')->title('User Name'),
            Column::make('loan_date'),
            Column::make('return_date'),
            Column::make('status'),
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
        return 'Loans' . date('YmdHis');
    }
}
