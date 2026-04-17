<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaResource\Pages;
use App\Models\Media;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Gallery';
    protected static ?string $modelLabel = 'Media';
    protected static ?string $pluralModelLabel = 'Gallery Media';
    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Media Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\Select::make('category')
                            ->label('Category')
                            ->options([
                                'wood' => 'Wood',
                                'stone' => 'Stone',
                                'metal' => 'Metal',
                            ])
                            ->required(),
                        
                        Forms\Components\Select::make('type')
                            ->label('Type')
                            ->options([
                                'image' => 'Image',
                                'video' => 'Video',
                            ])
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (Forms\Set $set, $state) {
                                $set('file_path', null);
                            }),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('File Upload')
                    ->schema([
                        Forms\Components\FileUpload::make('file_path')
                            ->label('Upload File')
                            ->required()
                            ->live()
                            ->disk('public_root')
                            ->directory('images/media')
                            ->acceptedFileTypes(function (Forms\Get $get) {
                                $type = $get('type');
                                return $type === 'video'
                                    ? ['video/mp4', 'video/quicktime', 'video/mov']
                                    : ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                            })
                            ->maxSize(51200) // 50MB
                            ->previewable(true)
                            ->downloadable(),
                    ]),
                
                Forms\Components\Section::make('Display Settings')
                    ->schema([
                        Forms\Components\TextInput::make('display_order')
                            ->label('Display Order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                        
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured')
                            ->default(false)
                            ->helperText('Show in featured section on homepage'),
                        
                        Forms\Components\Toggle::make('is_published')
                            ->label('Published')
                            ->default(true)
                            ->helperText('Make visible on website'),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('file_path')
                    ->label('Preview')
                    ->disk('public_root')
                    ->square()
                    ->size(60)
                    ->defaultImageUrl(url('/images/placeholder.jpg')),
                
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\BadgeColumn::make('category')
                    ->label('Category')
                    ->colors([
                        'warning' => 'wood',
                        'secondary' => 'stone',
                        'primary' => 'metal',
                    ]),
                
                Tables\Columns\IconColumn::make('type')
                    ->label('Type')
                    ->icon(fn (string $state): string => match ($state) {
                        'image' => 'heroicon-o-photo',
                        'video' => 'heroicon-o-video-camera',
                        default => 'heroicon-o-question-mark-circle',
                    }),
                
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),
                
                Tables\Columns\IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean(),
                
                Tables\Columns\TextColumn::make('display_order')
                    ->label('Order')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M d, Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'wood' => 'Wood',
                        'stone' => 'Stone',
                        'metal' => 'Metal',
                    ]),
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'image' => 'Image',
                        'video' => 'Video',
                    ]),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured Only'),
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Published Only'),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('display_order', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
        ];
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canView($record): bool
    {
        return false;
    }
}
