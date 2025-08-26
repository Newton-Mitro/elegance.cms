import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/react';
import {
    AtSignIcon,
    BadgeCheckIcon,
    BellDotIcon,
    CalendarClockIcon,
    HandPlatterIcon,
    HandshakeIcon,
    IdCard,
    ImagesIcon,
    LayoutGrid,
    MedalIcon,
    NotebookIcon,
    SettingsIcon,
    StoreIcon,
    TrophyIcon,
    UploadIcon,
    UserRoundCheckIcon,
    UsersRoundIcon,
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
        href: '/admin/media-files',
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
        title: 'Services',
        href: '/admin/services',
        icon: HandPlatterIcon,
    },
    {
        title: 'Teams',
        href: '/admin/teams',
        icon: IdCard,
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
        title: 'Awards',
        href: '/admin/awards',
        icon: TrophyIcon,
    },
    {
        title: 'Careers',
        href: '/admin/careers',
        icon: HandshakeIcon,
    },
    {
        title: 'Testimonials',
        href: '/admin/testimonials',
        icon: BadgeCheckIcon,
    },
    {
        title: 'Users',
        href: '/admin/users',
        icon: UsersRoundIcon,
    },
    {
        title: 'Settings',
        href: '/admin/settings',
        icon: SettingsIcon,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Developer Profile',
        href: 'https://www.linkedin.com/in/newton-mitro-24229311/',
        icon: UserRoundCheckIcon,
    },
    {
        title: 'Email Me',
        href: 'mailto:newtonmitro@gmail.com',
        icon: AtSignIcon,
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
