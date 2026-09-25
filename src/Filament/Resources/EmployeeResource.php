<?php

namespace Shazzoo\Employees\Filament\Resources;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use FinnWiel\ShazzooMedia\Components\Forms\ShazzooMediaPicker;
use Shazzoo\ContentStudioCore\Filament\Forms\LocaleFields;
use Shazzoo\Employees\Filament\Resources\EmployeeResource\Pages;
use Shazzoo\Employees\Models\Employee;

final class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 20;

    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return 'Plugins';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->columns(2)->schema([
            LocaleFields::locale(),
            LocaleFields::translationOf(Employee::class, 'name'),
            ShazzooMediaPicker::make('image_id')
                ->label('Image')
                ->conversions(['profile', 'thumbnail'])
                ->required()
                ->columnSpanFull(),
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('role')
                ->required()
                ->maxLength(255),
            TagsInput::make('skills')
                ->required()
                ->separator(',')
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                LocaleFields::column(),
                TextColumn::make('role')->searchable()->sortable(),
                TextColumn::make('skills')->badge(),
            ])
            ->filters([
                LocaleFields::filter(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
