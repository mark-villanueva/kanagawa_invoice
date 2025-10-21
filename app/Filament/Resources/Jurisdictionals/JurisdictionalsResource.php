<?php

namespace App\Filament\Resources\Jurisdictionals;

use App\Filament\Resources\Jurisdictionals\Pages\CreateJurisdictionals;
use App\Filament\Resources\Jurisdictionals\Pages\EditJurisdictionals;
use App\Filament\Resources\Jurisdictionals\Pages\ListJurisdictionals;
use App\Filament\Resources\Jurisdictionals\Schemas\JurisdictionalsForm;
use App\Filament\Resources\Jurisdictionals\Tables\JurisdictionalsTable;
use App\Models\Jurisdictionals;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JurisdictionalsResource extends Resource
{
    protected static ?string $model = Jurisdictionals::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = '管轄事務所一覧';
    protected static ?string $modelLabel = '管轄事務所一覧';
    protected static ?string $pluralModelLabel = '管轄事務所一覧';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $breadcrumb = '管轄事務所';
    protected static string | UnitEnum | null $navigationGroup  = 'マスタ保守'; 

    public static function form(Schema $schema): Schema
    {
        return JurisdictionalsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JurisdictionalsTable::configure($table);
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
            'index' => ListJurisdictionals::route('/'),
            'create' => CreateJurisdictionals::route('/create'),
            'edit' => EditJurisdictionals::route('/{record}/edit'),
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
