import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/react';
import {
    BadgeCheckIcon,
    BellDotIcon,
    BriefcaseIcon,
    CalendarCheck2Icon,
    CalendarClockIcon,
    HandPlatterIcon,
    HandshakeIcon,
    ImagePlusIcon,
    ImagesIcon,
    LayoutGrid,
    MedalIcon,
    NotebookIcon,
    PickaxeIcon,
    RssIcon,
    School2Icon,
    SplitIcon,
    StoreIcon,
    TrophyIcon,
    UploadIcon,
    UserRoundCheckIcon,
    UsersRoundIcon,
    ViewIcon,
} from 'lucide-react';
import AppLogo from './app-logo';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'Media',
        href: '/admin/media',
        icon: UploadIcon,
    },
    {
        title: 'Pages',
        href: '/admin/pages',
        icon: NotebookIcon,
    },
    {
        title: 'Home Sliders',
        href: '/admin/hero_sliders',
        icon: ImagesIcon,
    },
    {
        title: 'Categories',
        href: '/admin/categories',
        icon: SplitIcon,
    },
    {
        title: 'Teams',
        href: '/admin/teams',
        icon: BriefcaseIcon,
    },
    {
        title: 'Services',
        href: '/admin/services',
        icon: HandPlatterIcon,
    },
    {
        title: 'Service Appointments',
        href: '/admin/appointments',
        icon: CalendarCheck2Icon,
    },
    {
        title: 'Products',
        href: '/admin/products',
        icon: StoreIcon,
    },
    {
        title: 'Projects',
        href: '/admin/projects',
        icon: MedalIcon,
    },
    {
        title: 'Notices',
        href: '/admin/notices',
        icon: BellDotIcon,
    },
    {
        title: 'Events',
        href: '/admin/events',
        icon: CalendarClockIcon,
    },
    {
        title: 'Galleries',
        href: '/admin/galleries',
        icon: ImagePlusIcon,
    },
    {
        title: 'Students',
        href: '/admin/students',
        icon: School2Icon,
    },
    {
        title: 'Partners',
        href: '/admin/partners',
        icon: HandshakeIcon,
    },
    {
        title: 'Awards',
        href: '/admin/awards',
        icon: TrophyIcon,
    },
    {
        title: 'Job Circulars',
        href: '/admin/job_circulars',
        icon: PickaxeIcon,
    },
    {
        title: 'Job Applications',
        href: '/admin/job_applications',
        icon: ViewIcon,
    },
    {
        title: 'Testimonials',
        href: '/admin/testimonials',
        icon: BadgeCheckIcon,
    },
    {
        title: 'Blogs',
        href: '/admin/posts',
        icon: RssIcon,
    },
    {
        title: 'Users',
        href: '/admin/users',
        icon: UsersRoundIcon,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Developer Profile',
        href: 'https://www.linkedin.com/in/newton-mitro-24229311/',
        icon: UserRoundCheckIcon,
    },
];

export function AppSidebar() {
    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href="/dashboard" prefetch>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={mainNavItems} />
            </SidebarContent>

            <SidebarFooter>
                <NavFooter items={footerNavItems} className="mt-auto" />
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
