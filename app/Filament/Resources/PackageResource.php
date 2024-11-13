<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Package;
use Filament\Forms\Form;
use App\Models\GroupClass;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\PackageResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PackageResource\RelationManagers\QuestionsRelationManager;
use App\Models\PackageQuestion;
use Filament\Support\Enums\Alignment;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),
                Select::make('group_class_id')
                    ->label('Group Class')
                    ->relationship('groupClass')
                    ->required()
                    ->native(false)
                    ->getOptionLabelFromRecordUsing(function (GroupClass $record) {
                        $majorName = $record->major ? $record->major->name : '';
                        $subjectName = $record->subject ? $record->subject->name : '';
                        
                        return "{$record->name} {$majorName} {$subjectName}";
                    }),
                Fieldset::make('Exam Time')
                    ->schema([
                        DateTimePicker::make('started_at')
                            ->native(false)
                            ->label('Start Time')
                            ->seconds(false)
                            ->required(),
                        DateTimePicker::make('ended_at')
                            ->native(false)
                            ->label('End Time')
                            ->seconds(false)
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->description('')
                    ->searchable(),
                Tables\Columns\TextColumn::make('number_of_question')
                    ->label('Number of Questions')
                    ->getStateUsing(function (Package $record) {
                        return $record->countQuestions();
                    })
                    ->alignment(Alignment::Center),
                Tables\Columns\TextColumn::make('started_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ended_at')
                    ->dateTime()
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
            QuestionsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}
