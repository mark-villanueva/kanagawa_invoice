<?php

namespace App\Filament\Resources\Units;

use App\Filament\Resources\Units\Pages\CreateUnits;
use App\Filament\Resources\Units\Pages\EditUnits;
use App\Filament\Resources\Units\Pages\ListUnits;
use App\Filament\Resources\Units\Schemas\UnitsForm;
use App\Filament\Resources\Units\Tables\UnitsTable;
use App\Models\Units;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UnitsResource extends Resource
{
    protected static ?string $model = Units::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?int $navigationSort = 5;

    protected static ?string $navigationLabel = '単価一覧';
    protected static ?string $modelLabel = '単価一覧';
    protected static ?string $pluralModelLabel = '単価一覧';
    protected static ?string $breadcrumb = '単価';
    protected static string | UnitEnum | null $navigationGroup  = 'マスタ保守'; 

    public static function form(Schema $schema): Schema
    {
        return UnitsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UnitsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUnits::route('/'),
            'create' => CreateUnits::route('/create'),
            'edit' => EditUnits::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
