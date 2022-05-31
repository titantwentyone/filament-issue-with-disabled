<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersonResource\Pages;
use App\Filament\Resources\PersonResource\RelationManagers;
use App\Models\Person;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables;

class PersonResource extends Resource
{
    protected static ?string $model = Person::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

            ])
            ->filters([
                //
            ])
            ->prependActions([
                Action::make('test') 
                    ->icon(fn($record) => $record->flag ? 'heroicon-s-check' : 'heroicon-s-x')
                    ->color(fn($record) => $record->flag ? 'success' : 'danger')
                    ->label(fn($record) => $record->flag ? 'is true - make false' : 'is false - make true')
                    ->action(function($record) {
                        $record->flag = !$record->flag;
                        $record->save();
                    }),
                Action::make('othertest')
                    ->disabled(fn($record) => !$record->flag)
                    ->icon(fn($record) => $record->flag ? 'heroicon-s-check' : 'heroicon-s-x')
                    ->label(fn($record) => $record->flag ? 'is true - make false' : 'is false - make true')
                    ->color(fn($record) => $record->flag ? 'success' : 'danger')
                    ->action(function($record) {
                        $record->flag = !$record->flag;
                        $record->save();
                    })
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
            'index' => Pages\ListPeople::route('/'),
            'create' => Pages\CreatePerson::route('/create'),
            'edit' => Pages\EditPerson::route('/{record}/edit'),
        ];
    }
}
