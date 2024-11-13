<?php

namespace App\Filament\Resources\PackageResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Toggle;
use Filament\Support\Enums\Alignment;
use App\Tables\Columns\CountingAnswers;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class QuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'questions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                RichEditor::make('question')
                    ->required()
                    ->columnSpanFull(),
                RichEditor::make('explanation')
                    ->required()
                    ->columnSpanFull(),
                Repeater::make('answers')
                    ->required()
                    ->columnSpanFull()
                    ->schema([
                        RichEditor::make('answer'),
                        Toggle::make('is_the_right_answer')
                            ->label('The right answer')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-x-mark')
                    ])
                    ->grid(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('question')
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
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
