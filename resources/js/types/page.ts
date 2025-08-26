export interface Page {
    id: number;
    title: string;
    slug: string;
    meta_title?: string | null;
    meta_description?: string | null;
    created_at: string;
    updated_at: string;
}
