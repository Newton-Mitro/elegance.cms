import { Media } from '@/types/media';
import { X } from 'lucide-react';
import * as React from 'react';

interface MediaSelectorProps {
    media?: Media | null;
    onSelect: () => void;
    onRemove?: () => void;
    className?: string;
}

const MediaSelector: React.FC<MediaSelectorProps> = ({ media, onSelect, onRemove, className }) => {
    const renderPreview = () => {
        if (!media) {
            return (
                <div className="flex h-32 w-full items-center justify-center rounded border border-dashed border-gray-400">
                    <div>
                        <p className="text-gray-400">No media selected</p>
                        <p className="text-xs text-gray-400">Please select media</p>
                    </div>
                </div>
            );
        }

        const [mainType, subType] = media.file_type.split('/');

        if (mainType === 'image') {
            return <img src={media.url} alt={media.alt_text || 'Selected image'} className="h-32 w-full rounded object-cover" />;
        }

        if (mainType === 'video') {
            return (
                <video controls className="h-32 w-full rounded object-cover">
                    <source src={media.url} type={media.file_type} />
                    Your browser does not support the video tag.
                </video>
            );
        }

        if (mainType === 'audio') {
            return (
                <div className="flex h-32 w-full items-center justify-center rounded bg-gray-100 dark:bg-gray-800">
                    <audio controls className="w-full">
                        <source src={media.url} type={media.file_type} />
                        Your browser does not support the audio element.
                    </audio>
                </div>
            );
        }

        if (mainType === 'application' && subType === 'pdf') {
            return <iframe src={media.url} className="h-32 w-full rounded border" title={media.alt_text || 'PDF Preview'} />;
        }

        // fallback for docs/other files
        return (
            <div className="flex h-32 w-full flex-col items-center justify-center rounded border bg-gray-50 dark:bg-gray-800">
                <span className="text-sm text-gray-500">{media.file_type}</span>
                <a href={media.url} target="_blank" rel="noopener noreferrer" className="mt-1 text-blue-600 underline">
                    View File
                </a>
            </div>
        );
    };

    return (
        <div className={className || 'relative mt-2'}>
            <button type="button" onClick={onSelect} className="w-full rounded border p-0">
                {renderPreview()}
            </button>

            {media && onRemove && (
                <button
                    type="button"
                    onClick={onRemove}
                    className="absolute top-1 right-1 flex h-8 w-8 items-center justify-center rounded-full bg-white/80 text-gray-600 hover:bg-red-500 hover:text-white dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-red-500"
                    title="Remove media"
                >
                    <X className="h-4 w-4" />
                </button>
            )}
        </div>
    );
};

export { MediaSelector };
