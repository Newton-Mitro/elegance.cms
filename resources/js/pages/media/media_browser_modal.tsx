import React from 'react';
import { Media } from '../../types/media';

interface MediaBrowserModalProps {
    isOpen: boolean;
    onClose: () => void;
    media: Media[];
    onSelect: (media: Media) => void;
}

const MediaBrowserModal: React.FC<MediaBrowserModalProps> = ({ isOpen, onClose, media, onSelect }) => {
    console.log(media);
    if (!isOpen) return null;

    return (
        <div className="bg-opacity-50 fixed inset-0 z-50 flex items-center justify-center bg-black">
            <div className="w-3/4 max-w-4xl rounded-lg shadow-lg">
                <div className="flex items-center justify-between border-b px-4 py-2">
                    <h2 className="text-lg font-bold">Select Media</h2>
                    <button onClick={onClose} className="text-gray-500 hover:text-gray-700">
                        ✕
                    </button>
                </div>

                <div className="grid max-h-[70vh] grid-cols-3 gap-4 overflow-y-auto p-4 md:grid-cols-4 lg:grid-cols-5">
                    {media.map((item) => (
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
        </div>
    );
};

export default MediaBrowserModal;
