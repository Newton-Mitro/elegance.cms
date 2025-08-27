import { Transition } from '@headlessui/react';
import { Form, Head, router } from '@inertiajs/react';
import React, { useState } from 'react';
import HeadingSmall from '../../components/heading-small';
import InputError from '../../components/input-error';
import { Button } from '../../components/ui/button';
import { Input } from '../../components/ui/input';
import { Label } from '../../components/ui/label';
import AppLayout from '../../layouts/app-layout';
import { Media } from '../../types/media';
import { PaginatedData } from '../../types/paginated_meta';
import MediaBrowserModal from '../media/media_browser_modal';

interface CreateProps {
    media: PaginatedData<Media>;
}

const Create: React.FC<CreateProps> = ({ media }) => {
    const [form, setForm] = useState({
        year: '',
        title: '',
        image_id: null as number | null,
    });

    const [isModalOpen, setIsModalOpen] = useState(false);
    const [selectedMedia, setSelectedMedia] = useState<Media | null>(null);

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        router.post('/awards', form);
    };

    return (
        <AppLayout>
            <Head title="Create Award" />
            <div className="h-[calc(100vh-100px)] space-y-8 overflow-auto p-6 md:w-4xl">
                <HeadingSmall title="Create Award" description="Add a new award with year, title, and image" />

                <Form
                    method="post"
                    action={route('awards.store')}
                    options={{
                        preserveScroll: true,
                    }}
                    className="space-y-6"
                >
                    {({ processing, recentlySuccessful, errors }) => (
                        <>
                            {/* Year */}
                            <div className="grid gap-2">
                                <Label htmlFor="year">Year</Label>
                                <Input
                                    id="year"
                                    name="year"
                                    type="text"
                                    value={form.year}
                                    onChange={(e) => setForm({ ...form, year: e.target.value })}
                                    className="mt-1 block w-full"
                                    placeholder="Award year"
                                    required
                                />
                                <InputError className="mt-2" message={errors.year} />
                            </div>

                            {/* Title */}
                            <div className="grid gap-2">
                                <Label htmlFor="title">Title</Label>
                                <Input
                                    id="title"
                                    name="title"
                                    type="text"
                                    value={form.title}
                                    onChange={(e) => setForm({ ...form, title: e.target.value })}
                                    className="mt-1 block w-full"
                                    placeholder="Award title"
                                    required
                                />
                                <InputError className="mt-2" message={errors.title} />
                            </div>

                            {/* Image */}
                            <div className="grid gap-2">
                                <Label>Image</Label>
                                {selectedMedia ? (
                                    <div className="mb-2">
                                        <img src={selectedMedia.url} alt={selectedMedia.file_name || 'selected'} className="h-24 rounded" />
                                    </div>
                                ) : (
                                    <p className="text-sm text-muted-foreground">No image selected</p>
                                )}
                                <Button type="button" onClick={() => setIsModalOpen(true)}>
                                    Browse Media
                                </Button>
                                <InputError className="mt-2" message={errors.image_id} />
                            </div>

                            {/* Actions */}
                            <div className="flex items-center gap-4">
                                <Button disabled={processing}>Save</Button>

                                <Transition
                                    show={recentlySuccessful}
                                    enter="transition ease-in-out"
                                    enterFrom="opacity-0"
                                    leave="transition ease-in-out"
                                    leaveTo="opacity-0"
                                >
                                    <p className="text-sm text-neutral-600">Saved</p>
                                </Transition>
                            </div>

                            {/* Media Modal */}
                            <MediaBrowserModal
                                isOpen={isModalOpen}
                                onClose={() => setIsModalOpen(false)}
                                media={media}
                                onSelect={(m) => {
                                    setSelectedMedia(m);
                                    setForm({ ...form, image_id: m.id });
                                }}
                            />
                        </>
                    )}
                </Form>
            </div>
        </AppLayout>
    );
};

export default Create;
