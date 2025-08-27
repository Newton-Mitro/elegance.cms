import { router } from '@inertiajs/react';
import { Copy, File, FileArchive, FileText, HeadphonesIcon, Tv2Icon, Upload, X } from 'lucide-react';
import React, { useState } from 'react';
import HeadingSmall from '../../components/heading-small';
import { Select } from '../../components/ui/select';
import { Media } from '../../types/media';
import { PaginatedData } from '../../types/paginated_meta';

interface MediaBrowserModalProps {
    isOpen: boolean;
    onClose: () => void;
    media: PaginatedData<Media>;
    onSelect: (media: Media) => void;
    onUpload?: (file: File) => void; // optional upload handler
}

const MediaBrowserModal: React.FC<MediaBrowserModalProps> = ({ isOpen, onClose, media, onSelect, onUpload }) => {
    const [filter, setFilter] = useState<string>('all');

    if (!isOpen) return null;

    const handleCopy = async (url: string) => {
        try {
            await navigator.clipboard.writeText(url);
            alert('URL copied to clipboard!');
        } catch (err) {
            console.error('Failed to copy: ', err);
        }
    };

    const renderPreview = (item: Media) => {
        if (item.file_type.startsWith('image/')) {
            return <img src={item.url} alt={item.alt_text || 'media'} className="h-32 w-full rounded object-cover" />;
        } else if (item.file_type === 'application/pdf') {
            return (
                <div className="flex h-32 w-full items-center justify-center rounded bg-red-100">
                    <FileText className="h-12 w-12 text-red-600" />
                </div>
            );
        } else if (
            item.file_type.includes('word') ||
            item.file_type.includes('msword') ||
            item.file_type.includes('spreadsheet') ||
            item.file_type.includes('excel')
        ) {
            return (
                <div className="flex h-32 w-full items-center justify-center rounded bg-blue-100">
                    <FileText className="h-12 w-12 text-blue-600" />
                </div>
            );
        } else if (
            item.file_type.includes('zip') ||
            item.file_type.includes('rar') ||
            item.file_type.includes('tar') ||
            item.file_type.includes('gzip') ||
            item.file_type.includes('7z')
        ) {
            return (
                <div className="flex h-32 w-full items-center justify-center rounded bg-yellow-100">
                    <FileArchive className="h-12 w-12 text-yellow-600" />
                </div>
            );
        } else if (item.file_type.includes('audio')) {
            return (
                <div className="flex h-32 w-full items-center justify-center rounded bg-yellow-100">
                    <HeadphonesIcon className="h-12 w-12 text-yellow-600" />
                </div>
            );
        } else if (item.file_type.includes('video')) {
            return (
                <div className="flex h-32 w-full items-center justify-center rounded bg-yellow-100">
                    <Tv2Icon className="h-12 w-12 text-yellow-600" />
                </div>
            );
        } else {
            return (
                <div className="flex h-32 w-full items-center justify-center rounded bg-gray-100">
                    <File className="h-12 w-12 text-gray-600" />
                </div>
            );
        }
    };

    const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        if (e.target.files && e.target.files[0]) {
            onUpload?.(e.target.files[0]);
        }
    };

    const filteredMedia = media.data.filter((item) => {
        switch (filter) {
            case 'all':
                return true;
            case 'images':
                return item.file_type.startsWith('image/');
            case 'videos':
                return item.file_type.startsWith('video/');
            case 'audio':
                return item.file_type.startsWith('audio/');
            case 'pdf':
                return item.file_type === 'application/pdf';
            case 'docs':
                return (
                    item.file_type.includes('word') ||
                    item.file_type.includes('msword') ||
                    item.file_type.includes('spreadsheet') ||
                    item.file_type.includes('excel') ||
                    item.file_type.includes('presentation') ||
                    item.file_type.includes('powerpoint')
                );
            case 'archives':
                return (
                    item.file_type.includes('zip') ||
                    item.file_type.includes('rar') ||
                    item.file_type.includes('7z') ||
                    item.file_type.includes('tar') ||
                    item.file_type.includes('gzip')
                );
            default:
                return true;
        }
    });

    return (
        <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-2 backdrop-blur-sm">
            <div className="flex h-[80vh] w-full max-w-4xl flex-col overflow-hidden rounded-lg border bg-background shadow-lg md:h-[70vh] md:w-3/4">
                {/* Header */}
                <div className="flex items-center justify-between border-b px-4 py-2">
                    <HeadingSmall title="Media Browser" description="Select media from the library" />
                    <button onClick={onClose} className="text-gray-500 hover:text-gray-700">
                        <X className="h-6 w-6" />
                    </button>
                </div>

                {/* Upload & Filter */}
                <div className="flex flex-col gap-2 border-b px-4 py-2 sm:flex-row sm:items-center sm:justify-between">
                    <label className="flex cursor-pointer items-center gap-2 rounded bg-blue-900 px-3 py-1 text-sm hover:bg-blue-600">
                        <Upload className="h-4 w-4" />
                        <span>Upload</span>
                        <input type="file" className="hidden" onChange={handleFileChange} />
                    </label>

                    <div className="">
                        <Select
                            value={filter}
                            onChange={(e) => setFilter(e.target.value)}
                            className="w-64 rounded border px-2 text-sm"
                            options={[
                                { value: 'all', label: 'All Types' },
                                { value: 'images', label: 'Images' },
                                { value: 'videos', label: 'Videos' },
                                { value: 'audio', label: 'Audio' },
                                { value: 'pdf', label: 'PDFs' },
                                { value: 'docs', label: 'Word/Excel/PowerPoint' },
                                { value: 'archives', label: 'Archives' },
                            ]}
                        ></Select>
                    </div>
                </div>

                {/* Media Grid */}
                <div className="flex-1 overflow-y-auto p-3 md:p-4">
                    <div className="grid grid-cols-2 gap-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
                        {filteredMedia.map((item) => (
                            <div key={item.id} className="relative rounded border p-2 hover:border-blue-500">
                                <div
                                    className="cursor-pointer"
                                    onClick={() => {
                                        onSelect(item);
                                        onClose();
                                    }}
                                >
                                    {renderPreview(item)}
                                    <p className="mt-2 truncate text-center text-xs sm:text-sm">{`ID #${item.id}`}</p>
                                    <p className="mt-2 truncate text-center text-xs sm:text-sm">{`${item.file_type}`}</p>
                                </div>

                                {/* Copy URL */}
                                <button
                                    onClick={() => handleCopy(item.url)}
                                    className="absolute top-2 right-2 flex items-center gap-1 rounded bg-gray-950 p-1 shadow hover:bg-gray-900"
                                >
                                    <Copy className="h-3 w-3 text-white" />
                                </button>
                            </div>
                        ))}
                    </div>
                </div>

                {/* Pagination */}
                <div className="flex flex-wrap items-center justify-center gap-2 border-t px-2 py-2 md:px-4">
                    {media.links.map((link, i) => (
                        <button
                            key={i}
                            disabled={!link.url}
                            className={`rounded px-2 py-1 text-xs sm:px-3 sm:py-1 sm:text-sm ${
                                link.active ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100'
                            } disabled:opacity-50`}
                            onClick={() => {
                                if (link.url) router.get(link.url, {}, { preserveScroll: true, preserveState: true });
                            }}
                            dangerouslySetInnerHTML={{ __html: link.label }}
                        />
                    ))}
                </div>
            </div>
        </div>
    );
};

export default MediaBrowserModal;
