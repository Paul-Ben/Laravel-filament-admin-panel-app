<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('bookingId')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('hotelId')
                    ->tel()
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('roomId')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('guestId')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('checkinDate')
                    ->required(),
                Forms\Components\DatePicker::make('checkoutDate')
                    ->required(),
                Forms\Components\TextInput::make('no_of_guests')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bookingId')
                    ->searchable(),
                Tables\Columns\TextColumn::make('hotelId')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('roomId')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('guestId')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('checkinDate')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('checkoutDate')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('no_of_guests')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'view' => Pages\ViewBooking::route('/{record}'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
