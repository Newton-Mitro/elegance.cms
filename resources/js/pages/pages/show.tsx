import { Head, Link } from '@inertiajs/react';
import React from 'react';
import AppLayout from '../../layouts/app-layout';
import { BreadcrumbItem } from '../../types';
import { Page } from '../../types/page';

interface PageProps {
    page: Page;
}

const Show: React.FC<PageProps> = ({ page }) => {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Dashboard', href: '/dashboard' },
        { title: 'Pages', href: '/admin/pages' },
        { title: 'View Media', href: '' },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Show Page" />
            <div className="p-6">
                <h1 className="mb-2 text-xl font-bold">{page.title}</h1>
                <p className="mb-2 text-gray-600"> {page.meta_title}</p>
                <p>{page.meta_description}</p>
                <Link href={route('pages.index')} className="btn mt-4">
                    Back to list
                </Link>
            </div>
        </AppLayout>
    );
};

export default Show;
