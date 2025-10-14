<?php

namespace App\Filament\Resources\Businesses;

use App\Filament\Resources\Businesses\Pages\CreateBusinesses;
use App\Filament\Resources\Businesses\Pages\EditBusinesses;
use App\Filament\Resources\Businesses\Pages\ListBusinesses;
use App\Filament\Resources\Businesses\Pages\ViewBusinesses;
use App\Filament\Resources\Businesses\Schemas\BusinessesForm;
use App\Filament\Resources\Businesses\Schemas\BusinessesInfolist;
use App\Filament\Resources\Businesses\Tables\BusinessesTable;
use App\Models\Businesses;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BusinessesResource extends Resource
{
    protected static ?string $model = Businesses::class;

    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = '事業者一覧';
    protected static string | UnitEnum | null $navigationGroup  = 'マスタ保守';
    
    protected static ?string $modelLabel = '事業者一覧';
    protected static ?string $pluralModelLabel = '事業者一覧';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $breadcrumb = '事業者一覧';

    public static function form(Schema $schema): Schema
    {
        return BusinessesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BusinessesTable::configure($table);
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
            'index' => ListBusinesses::route('/'),
            'create' => CreateBusinesses::route('/create'),
            'edit' => EditBusinesses::route('/{record}/edit'),
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
