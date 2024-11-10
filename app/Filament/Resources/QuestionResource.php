<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Question;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Support\Enums\Alignment;
use App\Tables\Columns\CountingAnswers;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Resources\QuestionResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\QuestionResource\RelationManagers;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                RichEditor::make('question')
                    ->label('Question')
                    ->required()
                    ->columnSpanFull(),
                RichEditor::make('explanation')
                    ->label('Explanation')
                    ->required()
                    ->columnSpanFull(),
                Repeater::make('answers')
                    ->label('Answer Options')
                    ->required()
                    ->columnSpanFull()
                    ->schema([
                        RichEditor::make('answer')
                            ->label('Answer'),
                        Toggle::make('is_the_right_answer')
                            ->label('Correct Answer')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-x-mark')
                    ])
                    ->grid(2)
                    ->defaultItems(4)
                    ->addActionLabel('Add answer options')
                    ->cloneable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question')
                    ->label('Question')
                    ->html()
                    ->searchable(),
                Tables\Columns\TextColumn::make('explanation')
                    ->label('Explanation')
                    ->html()
                    ->searchable(),
                CountingAnswers::make('answers')
                    ->label('Number of Options')
                    ->alignment(Alignment::Center),
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
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
