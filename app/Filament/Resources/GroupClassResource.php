<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Major;
use Filament\Forms\Form;
use App\Models\GroupClass;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\GroupClassResource\Pages;
use App\Filament\Resources\GroupClassResource\RelationManagers;

class GroupClassResource extends Resource
{
    protected static ?string $model = GroupClass::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('subject_id')
                    ->required()
                    ->label('Subject')
                    ->relationship('subject', 'name')
                    ->native(false)
                    ->searchable(),
                Select::make('major_id')
                    ->label('Major')
                    ->options(Major::all()->pluck('name', 'id'))
                    ->native(false)
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject.name')
                    ->label('Subject')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('major.name')
                    ->label('Major')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListGroupClasses::route('/'),
            'create' => Pages\CreateGroupClass::route('/create'),
            'edit' => Pages\EditGroupClass::route('/{record}/edit'),
        ];
    }
}
