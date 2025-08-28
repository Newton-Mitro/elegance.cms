import React from 'react';
import { Media } from '../types/media';

interface MediaPreviewProps {
    media: Media;
}

const MediaPreview: React.FC<MediaPreviewProps> = ({ media }) => {
    const type = media.file_type.toLowerCase();

    // Responsive height classes
    const imgHeight = 'h-48 sm:h-64';
    const videoHeight = 'h-64 sm:h-80';
    const embedHeight = 'h-96 sm:h-[32rem]';

    const containerClass = 'mt-4';
    const borderBgClass = 'rounded-lg border bg-gray-50 dark:bg-gray-800 dark:border-gray-700';
    const textClass = 'text-sm text-gray-700 dark:text-gray-300 truncate';

    if (type.startsWith('image/')) {
        return (
            <div className={containerClass}>
                <img
                    src={media.url}
                    alt={media.alt_text || media.file_name}
                    className={`${imgHeight} w-full rounded-lg object-cover shadow-sm dark:shadow-none`}
                />
            </div>
        );
    }

    if (type.startsWith('video/')) {
        return (
            <div className={containerClass}>
                <video controls className={`${videoHeight} w-full rounded-lg shadow-sm dark:shadow-none`}>
                    <source src={media.url} type={media.file_type} />
                    Your browser does not support the video tag.
                </video>
            </div>
        );
    }

    if (type.startsWith('audio/')) {
        return (
            <div className={containerClass}>
                <audio controls className="w-full">
                    <source src={media.url} type={media.file_type} />
                    Your browser does not support the audio element.
                </audio>
            </div>
        );
    }

    if (type === 'application/pdf') {
        return (
            <div className={containerClass}>
                <embed src={media.url} type="application/pdf" className={`${embedHeight} w-full rounded-lg border dark:border-gray-700`} />
                <p className={`mt-1 ${textClass}`}>{media.file_name}</p>
            </div>
        );
    }

    // fallback for other file types (docs, archives, etc.)
    return (
        <div className={`${containerClass} ${borderBgClass} p-2`}>
            <a
                href={media.url}
                target="_blank"
                rel="noopener noreferrer"
                className="block truncate text-sm text-blue-600 hover:underline dark:text-blue-400"
            >
                {media.file_name}
            </a>
        </div>
    );
};

export default MediaPreview;
