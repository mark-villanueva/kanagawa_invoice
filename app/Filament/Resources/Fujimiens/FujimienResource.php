<?php

namespace App\Filament\Resources\Fujimiens;

use App\Filament\Resources\Fujimiens\Pages\CreateFujimien;
use App\Filament\Resources\Fujimiens\Pages\EditFujimien;
use App\Filament\Resources\Fujimiens\Pages\ListFujimiens;
use App\Filament\Resources\Fujimiens\Schemas\FujimienForm;
use App\Filament\Resources\Fujimiens\Tables\FujimiensTable;
use App\Models\Fujimien;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FujimienResource extends Resource
{
    protected static ?string $model = Fujimien::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?int $navigationSort = 5;

    protected static ?string $navigationLabel = 'ふじみ園利用者一覧';
    protected static ?string $modelLabel = 'ふじみ園利用者一覧';
    protected static ?string $pluralModelLabel = 'ふじみ園利用者一覧';
    protected static ?string $breadcrumb = 'ふじみ園利用者';
    protected static string | UnitEnum | null $navigationGroup  = 'マスタ保守'; 

    public static function form(Schema $schema): Schema
    {
        return FujimienForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FujimiensTable::configure($table);
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
            'index' => ListFujimiens::route('/'),
            'create' => CreateFujimien::route('/create'),
            'edit' => EditFujimien::route('/{record}/edit'),
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
