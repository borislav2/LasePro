<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Filament\Resources\ReservationResource\RelationManagers;
use App\Models\Reservation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Reservations';
    protected static ?string $modelLabel = 'Reservation';
    protected static ?string $pluralModelLabel = 'Reservations';
    protected static ?string $navigationGroup = 'Laser Cleaning';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Reservation Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Customer Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('address')
                            ->label('Address in Varna')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('preferred_date')
                            ->label('Preferred Date')
                            ->native(false),
                        Forms\Components\Textarea::make('message')
                            ->label('Project Details')
                            ->rows(3),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Status Management')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Reservation Status')
                            ->options([
                                'pending' => 'Pending',
                                'confirmed' => 'Confirmed',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required()
                            ->default('pending'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('service_type')
                    ->label('Service')
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'graffiti_removal' => 'Graffiti Removal',
                        'roof_facade' => 'Roof & Facade',
                        'metal_wood' => 'Metal & Wood',
                        'gravestone' => 'Gravestone',
                        'other' => 'Other',
                        default => $state,
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->label('Address')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('preferred_date')
                    ->label('Preferred Date')
                    ->date()
                    ->sortable()
                    ->placeholder('Not specified'),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'confirmed',
                        'primary' => 'completed',
                        'danger' => 'cancelled',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('service_type')
                    ->label('Service Type')
                    ->options([
                        'graffiti_removal' => 'Graffiti Removal',
                        'roof_facade' => 'Roof & Facade Cleaning',
                        'metal_wood' => 'Metal & Wood Restoration',
                        'gravestone' => 'Gravestone Cleaning',
                        'other' => 'Other',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('confirm')
                    ->label('Confirm')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn (Reservation $record) => $record->update(['status' => 'confirmed']))
                    ->visible(fn (Reservation $record): bool => $record->status === 'pending'),
                Tables\Actions\Action::make('complete')
                    ->label('Complete')
                    ->icon('heroicon-o-check')
                    ->color('primary')
                    ->requiresConfirmation()
                    ->action(fn (Reservation $record) => $record->update(['status' => 'completed']))
                    ->visible(fn (Reservation $record): bool => $record->status === 'confirmed'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }
}
