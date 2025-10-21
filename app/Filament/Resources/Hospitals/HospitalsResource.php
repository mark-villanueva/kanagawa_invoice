<?php

namespace App\Filament\Resources\Hospitals;

use App\Filament\Resources\Hospitals\Pages\CreateHospitals;
use App\Filament\Resources\Hospitals\Pages\EditHospitals;
use App\Filament\Resources\Hospitals\Pages\ListHospitals;
use App\Filament\Resources\Hospitals\Schemas\HospitalsForm;
use App\Filament\Resources\Hospitals\Tables\HospitalsTable;
use App\Models\Hospitals;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HospitalsResource extends Resource
{
    protected static ?string $model = Hospitals::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = '病院一覧';
    protected static ?string $modelLabel = '病院一覧';
    protected static ?string $pluralModelLabel = '病院一覧';
    protected static ?string $recordTitleAttribute = 'hospital_name';
    protected static ?string $breadcrumb = '病院';
    protected static string | UnitEnum | null $navigationGroup  = 'マスタ保守'; 

    public static function form(Schema $schema): Schema
    {
        return HospitalsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HospitalsTable::configure($table);
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
            'index' => ListHospitals::route('/'),
            'create' => CreateHospitals::route('/create'),
            'edit' => EditHospitals::route('/{record}/edit'),
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
