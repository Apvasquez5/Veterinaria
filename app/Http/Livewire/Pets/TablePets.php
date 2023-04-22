<?php
namespace App\Http\Livewire\Pets;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

/**
 * Summary of TablePets
 */
class TablePets extends DataTableComponent
{
    protected $model = Pets::class;
    public $myParam = 'Default';

    public string $tableName = 'users1';

    public array $users1 = [];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
           
            ->setAdditionalSelects(['users.id as id'])
            // ->setConfigurableAreas([
            //     'toolbar-left-start' => ['includes.areas.toolbar-left-start', ['param1' => $this->myParam, 'param2' => ['param2' => 2]]],
            // ])
//            ->setPaginationMethod('simple')
            ->setReorderEnabled()
            ->setHideReorderColumnUnlessReorderingEnabled()
            ->setSecondaryHeaderTrAttributes(function ($rows) {
                return ['class' => 'bg-gray-100'];
            })
            ->setSecondaryHeaderTdAttributes(function (Column $column, $rows) {
                if ($column->isField('id')) {
                    return ['class' => 'text-red-500'];
                }

                return ['default' => true];
            })->setPerPageAccepted([8, 15, 20])
            ->setFooterTrAttributes(function ($rows) {
                return ['class' => 'bg-red-900'];
            })
            ->setFooterTdAttributes(function (Column $column, $rows) {
                if ($column->isField('name')) {
                    return ['class' => 'text-green-500'];
                }

                return ['default' => true];
            })
            ->setHideBulkActionsWhenEmptyEnabled()
            ->setTableRowUrl(function ($row) {
                return 'https://google-'.$row->id.'.com';
            })
            ->setTableRowUrlTarget(function ($row) {
                return '_blank';
            });

    }



    public function columns(): array
    {
        
        return [
            Column::make('Order', 'sort')
            ->sortable()
            ->collapseOnMobile()
            ->excludeFromColumnSelect(),
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('E-mail', 'email')
                ->sortable()
                ->searchable(),
            ButtonGroupColumn::make('Actions')
                ->unclickable()
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('My Link 1')
                        ->title(fn($row) => 'Link 1')
                        ->location(fn($row) => 'https://' . $row->id . 'google1.com')
                        ->attributes(function ($row) {
                            return [
                                'target' => '_blank',
                                'class' => 'underline text-blue-500',
                            ];
                        }),
                    LinkColumn::make('My Link 2')
                        ->title(fn($row) => 'Link 2')
                        ->location(fn($row) => 'https://' . $row->id . 'google2.com')
                        ->attributes(function ($row) {
                            return [
                                'class' => 'underline text-blue-500',
                            ];
                        }),
                    LinkColumn::make('My Link 3')
                        ->title(fn($row) => 'Link 3')
                        ->location(fn($row) => 'https://' . $row->id . 'google3.com')
                        ->attributes(function ($row) {
                            return [
                                'class' => 'underline text-blue-500',
                            ];
                        }),
                ]),
            // Column::make('Address', 'address.address')
            //     ->sortable()
            //     ->searchable()
            //     ->collapseOnTablet(),
        ];
    }
   
    public function builder(): Builder
    {
        return User::query();
    }
    
    public function reorder($items): void
    {
        foreach ($items as $item) {
            User::find((int) $item['value'])->update(['sort' => (int) $item['order']]);
        }
    }

}