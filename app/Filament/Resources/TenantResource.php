<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenantResource\Pages;
use App\Filament\Resources\TenantResource\RelationManagers;
use App\Models\Tenant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TenantResource extends Resource
{
    protected static ?string $model = Tenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(191),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(191),
                        Forms\Components\TextInput::make('domain_name')
                            ->label('Domain Name')
                            ->required()
                            ->visible(fn ($livewire) => $livewire instanceof Pages\CreateTenant)
                            ->maxLength(191)
                            ->helperText('Will be created as {domain}.' . config('app.domain')),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required(fn ($livewire) => $livewire instanceof Pages\CreateTenant)
                            ->visible(fn ($livewire) => $livewire instanceof Pages\CreateTenant)
                            ->maxLength(191)
                            ->dehydrated(fn ($state) => filled($state)),
                        Forms\Components\TextInput::make('password_confirmation')
                            ->password()
                            ->required(fn ($livewire) => $livewire instanceof Pages\CreateTenant)
                            ->visible(fn ($livewire) => $livewire instanceof Pages\CreateTenant)
                            ->maxLength(191)
                            ->dehydrated(false)
                            ->same('password'),
                        Forms\Components\KeyValue::make('data')
                            ->visible(fn ($livewire) => $livewire instanceof Pages\EditTenant)
                            ->keyLabel('Key')
                            ->valueLabel('Value')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('domains.domain')
                    ->label('Domain')
                    ->searchable(),
            
                    Tables\Columns\TextColumn::make('data.tenancy_db_name')
                    ->label('Database')
                    ->searchable(false),               
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
            'index' => Pages\ListTenants::route('/'),
            'create' => Pages\CreateTenant::route('/create'),
            'edit' => Pages\EditTenant::route('/{record}/edit'),
        ];
    }
}