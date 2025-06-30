<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'Contact Messages';

    protected static ?string $modelLabel = 'Contact Message';

    protected static ?string $pluralModelLabel = 'Contact Messages';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Contact Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Message')
                    ->schema([
                        Forms\Components\Textarea::make('message')
                            ->required()
                            ->maxLength(1000)
                            ->rows(6)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Email copied!')
                    ->copyMessageDuration(1500),
                
                Tables\Columns\TextColumn::make('message')
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    })
                    ->wrap(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received At')
                    ->dateTime('M j, Y H:i')
                    ->sortable()
                    ->toggleable()
                    ->since()
                    ->tooltip(fn (Contact $record): string => $record->created_at->format('l, F j, Y \a\t H:i:s')),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('M j, Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('recent')
                    ->label('Recent (Last 7 days)')
                    ->query(fn (Builder $query): Builder => $query->where('created_at', '>=', now()->subDays(7))),
                
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->modalWidth('5xl'),
                
                Tables\Actions\Action::make('reply')
                    ->color('success')
                    ->url(fn (Contact $record): string => "mailto:{$record->email}?subject=Re: Your inquiry to CariDesa&body=Dear {$record->name},%0D%0A%0D%0AThank you for contacting CariDesa.%0D%0A%0D%0A")
                    ->openUrlInNewTab(),
                
                Tables\Actions\EditAction::make()
                    ->modalWidth('3xl'),
                
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    
                    Tables\Actions\BulkAction::make('mark_as_read')
                        ->label('Mark as Read')
                        ->color('success')
                        ->action(function ($records) {
                            // You can add a 'read_at' column to track read status
                            // For now, we'll just show a notification
                            \Filament\Notifications\Notification::make()
                                ->title('Messages marked as read')
                                ->success()
                                ->send();
                        }),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('30s') // Auto-refresh every 30 seconds
            ->striped();
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Contact Details')
                    ->schema([
                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('name')
                                    ->weight('bold'),
                                
                                Infolists\Components\TextEntry::make('email')
                                    ->copyable()
                                    ->url(fn (Contact $record): string => "mailto:{$record->email}")
                                    ->openUrlInNewTab(),
                            ]),
                        
                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('created_at')
                                    ->label('Received At')
                                    ->dateTime('l, F j, Y \a\t H:i:s'),                                
                                Infolists\Components\TextEntry::make('formatted_date')
                                    ->label('Time Ago')
                                    ->state(fn (Contact $record): string => $record->created_at->diffForHumans()),
                            ]),
                    ])
                    ->columns(1),
                
                Infolists\Components\Section::make('Message')
                    ->schema([
                        Infolists\Components\TextEntry::make('message')
                            ->prose()
                            ->hiddenLabel()
                            ->formatStateUsing(fn (string $state): HtmlString => new HtmlString(nl2br(e($state))))
                            ->extraAttributes(['class' => 'whitespace-pre-wrap']),
                    ]),
                
                Infolists\Components\Section::make('Actions')
                    ->schema([
                        Infolists\Components\Actions::make([
                            Infolists\Components\Actions\Action::make('reply_email')
                                ->label('Reply via Email')
                                ->color('primary')
                                ->url(fn (Contact $record): string => "mailto:{$record->email}?subject=Re: Your inquiry to CariDesa&body=Dear {$record->name},%0D%0A%0D%0AThank you for contacting CariDesa.%0D%0A%0D%0A")
                                ->openUrlInNewTab(),
                            
                            Infolists\Components\Actions\Action::make('call_whatsapp')
                                ->label('Contact via WhatsApp')
                                ->color('success')
                                ->url(fn (Contact $record): string => "https://wa.me/6282113372046?text=Hello, I am responding to a contact form inquiry from " . urlencode($record->name))
                                ->openUrlInNewTab(),
                        ]),
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'view' => Pages\ViewContact::route('/{record}'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('created_at', '>=', now()->subDays(7))->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $count = static::getModel()::where('created_at', '>=', now()->subDays(7))->count();
        
        if ($count > 10) {
            return 'danger';
        } elseif ($count > 5) {
            return 'warning';
        } elseif ($count > 0) {
            return 'success';
        }
        
        return null;
    }
}