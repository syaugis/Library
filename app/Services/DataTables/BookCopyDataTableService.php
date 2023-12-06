<?php

namespace App\Services\DataTables;

use App\Models\BookCopy;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BookCopyDataTableService extends DataTable
{
    private $bookId;

    public function withBookId($bookId)
    {
        $this->bookId = $bookId;
        return $this;
    }

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->editColumn('is_available', function ($query) {
                switch ($query->is_available) {
                    case '0':
                        return '<span class="text-capitalize badge bg-danger mb-2"> Not Available </span>';
                        break;
                    case '1':
                        return '<span class="text-capitalize badge bg-primary mb-2"> Is Available </span>';
                }
            })
            ->filterColumn('is_available', function ($query, $keyword) {
                $sql = 'CASE WHEN is_available = 0 THEN "Not Available" 
                           WHEN is_available = 1 THEN "Is Available" END like ?';
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('action', 'admin.book_copy.action')
            ->rawColumns(['action', 'is_available']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(BookCopy $model): QueryBuilder
    {
        if ($this->bookId) {
            return $model->where('book_id', $this->bookId)->newQuery();
        } else {
            return $model->newQuery()->with(['book:id,title'])
                ->select('book_copies.*');
        }
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('book_copies-table')
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
        $columns = [
            Column::make('id')->title('ID'),
            Column::make('is_available')->title('Availability'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->width(60)
                ->addClass('text-center hide-search'),
        ];

        if (!$this->bookId) {
            $columns[] = Column::make('book.title')->data('book.title')->title('Book Title');
            $columns = array_merge([$columns[0], $columns[3], $columns[1], $columns[2]]);
        }

        return $columns;
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'BookCopies_' . date('YmdHis');
    }
}
