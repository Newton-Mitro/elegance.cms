import { AnimatePresence, motion } from 'framer-motion';
import React, { useState } from 'react';

interface MediaCarouselProps {
    gallery: string[];
    showThumbnails?: boolean; // show thumbnails or dots
}

const MediaCarousel: React.FC<MediaCarouselProps> = ({ gallery, showThumbnails = true }) => {
    const [currentIndex, setCurrentIndex] = useState(0);
    const [direction, setDirection] = useState(0);

    const isImage = (url: string) => /\.(jpg|jpeg|png|gif|webp|svg)$/i.test(url);
    const isVideo = (url: string) => /\.(mp4|webm|ogg)$/i.test(url);

    const prev = () => {
        setDirection(-1);
        setCurrentIndex((prev) => (prev - 1 + gallery.length) % gallery.length);
    };

    const next = () => {
        setDirection(1);
        setCurrentIndex((prev) => (prev + 1) % gallery.length);
    };

    const goTo = (index: number) => {
        setDirection(index > currentIndex ? 1 : -1);
        setCurrentIndex(index);
    };

    const variants = {
        enter: (dir: number) => ({ x: dir > 0 ? 300 : -300, opacity: 0 }),
        center: { x: 0, opacity: 1 },
        exit: (dir: number) => ({ x: dir < 0 ? 300 : -300, opacity: 0 }),
    };

    return (
        <div className="w-full">
            {/* Carousel Preview */}
            <div className="relative mb-4 flex h-64 w-full items-center justify-center overflow-hidden rounded border md:h-96 dark:border-gray-700">
                {/* Prev/Next buttons on top */}
                <button
                    className="absolute top-1/2 left-2 z-10 -translate-y-1/2 rounded-full bg-gray-200 p-2 text-lg font-bold dark:bg-gray-700"
                    onClick={prev}
                >
                    ‹
                </button>
                <button
                    className="absolute top-1/2 right-2 z-10 -translate-y-1/2 rounded-full bg-gray-200 p-2 text-lg font-bold dark:bg-gray-700"
                    onClick={next}
                >
                    ›
                </button>

                <AnimatePresence custom={direction} initial={false}>
                    <motion.div
                        key={currentIndex}
                        custom={direction}
                        variants={variants}
                        initial="enter"
                        animate="center"
                        exit="exit"
                        transition={{ type: 'tween', duration: 0.4 }}
                        className="absolute inset-0 flex items-center justify-center"
                    >
                        {isImage(gallery[currentIndex]) ? (
                            <img src={gallery[currentIndex]} alt={`preview-${currentIndex}`} className="h-full w-full object-contain" />
                        ) : isVideo(gallery[currentIndex]) ? (
                            <video controls className="h-full w-full object-contain">
                                <source src={gallery[currentIndex]} />
                            </video>
                        ) : (
                            <p className="text-center text-gray-700 dark:text-gray-300">Cannot preview this file.</p>
                        )}
                    </motion.div>
                </AnimatePresence>
            </div>

            {/* Thumbnails or Dots */}
            {showThumbnails ? (
                <div className="mt-2 flex justify-center gap-2 overflow-x-auto">
                    {gallery.map((url, idx) => (
                        <div
                            key={idx}
                            className={`cursor-pointer rounded border ${
                                idx === currentIndex ? 'border-blue-500' : 'border-gray-300 dark:border-gray-700'
                            }`}
                            onClick={() => goTo(idx)}
                        >
                            {isImage(url) ? (
                                <img src={url} alt={`thumb-${idx}`} className="h-16 w-16 rounded object-cover" />
                            ) : isVideo(url) ? (
                                <video src={url} className="h-16 w-16 rounded object-cover" muted playsInline />
                            ) : (
                                <div className="flex h-16 w-16 items-center justify-center bg-gray-100 text-xs text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                                    File
                                </div>
                            )}
                        </div>
                    ))}
                </div>
            ) : (
                <div className="mt-2 flex justify-center gap-2">
                    {gallery.map((_, idx) => (
                        <button
                            key={idx}
                            className={`h-3 w-3 rounded-full transition-all duration-300 ${
                                idx === currentIndex ? 'scale-125 bg-blue-600 dark:bg-blue-400' : 'bg-gray-400 dark:bg-gray-600'
                            }`}
                            onClick={() => goTo(idx)}
                        />
                    ))}
                </div>
            )}
        </div>
    );
};

export default MediaCarousel;
