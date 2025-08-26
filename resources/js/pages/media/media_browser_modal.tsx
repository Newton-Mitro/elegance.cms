import { router } from '@inertiajs/react';
import React from 'react';
import { Media } from '../../types/media';

interface PaginatedMedia {
    data: Media[];
    links: {
        url: string | null;
        label: string;
        active: boolean;
    }[];
}

interface MediaBrowserModalProps {
    isOpen: boolean;
    onClose: () => void;
    media: PaginatedMedia;
    onSelect: (media: Media) => void;
}

const MediaBrowserModal: React.FC<MediaBrowserModalProps> = ({ isOpen, onClose, media, onSelect }) => {
    if (!isOpen) return null;

    return (
        <div className="bg-opacity-50 fixed inset-0 z-50 flex items-center justify-center bg-black">
            <div className="flex h-[80vh] w-3/4 max-w-4xl flex-col rounded-lg bg-transparent shadow-lg">
                {/* Header */}
                <div className="flex items-center justify-between border-b px-4 py-2">
                    <h2 className="text-lg font-bold">Select Media</h2>
                    <button onClick={onClose} className="text-gray-500 hover:text-gray-700">
                        ✕
                    </button>
                </div>

                {/* Media Grid (scrollable section) */}
                <div className="flex-1 overflow-y-auto p-4">
                    <div className="grid grid-cols-3 gap-4 md:grid-cols-4 lg:grid-cols-5">
                        {media.data.map((item) => (
                            <div
                                key={item.id}
                                className="cursor-pointer rounded border p-2 hover:border-blue-500"
                                onClick={() => {
                                    onSelect(item);
                                    onClose();
                                }}
                            >
                                <img src={item.url} alt={item.alt_text || 'media'} className="h-32 w-full rounded object-cover" />
                                <p className="mt-2 truncate text-center text-sm">{`${item.file_name}, ID #${item.id}`}</p>
                            </div>
                        ))}
                    </div>
                </div>

                {/* Pagination Controls */}
                <div className="flex items-center justify-center gap-2 border-t px-4 py-2">
                    {media.links.map((link, i) => (
                        <button
                            key={i}
                            disabled={!link.url}
                            className={`rounded px-3 py-1 text-sm ${
                                link.active ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100'
                            } disabled:opacity-50`}
                            onClick={() => {
                                if (link.url)
                                    router.get(
                                        link.url,
                                        {},
                                        {
                                            preserveScroll: true,
                                            preserveState: true,
                                        },
                                    );
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
