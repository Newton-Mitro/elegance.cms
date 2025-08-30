import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/react';

// Charts
import { ArcElement, BarElement, CategoryScale, Chart as ChartJS, Legend, LinearScale, LineElement, PointElement, Title, Tooltip } from 'chart.js';
import { Bar, Line } from 'react-chartjs-2';
import MediaPreview from '../components/media-preview';

ChartJS.register(CategoryScale, LinearScale, BarElement, PointElement, LineElement, Title, Tooltip, Legend, ArcElement);

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Dashboard', href: '/dashboard' }];

export default function Dashboard() {
    const { stats, monthlyVisitors, routeVisits, latestNotices, applications, media }: any = usePage().props;

    // Prepare chart data
    const monthlyVisitorsData = {
        labels: Object.keys(monthlyVisitors),
        datasets: [
            {
                label: 'Visitors',
                data: Object.values(monthlyVisitors),
                fill: true,
                backgroundColor: 'rgba(37, 99, 235, 0.2)',
                borderColor: 'rgba(37, 99, 235, 1)',
                tension: 0.3,
            },
        ],
    };

    const routeVisitedData = {
        labels: Object.keys(routeVisits),
        datasets: [
            {
                label: 'Visits',
                data: Object.values(routeVisits),
                backgroundColor: [
                    'rgba(37, 99, 235, 0.7)',
                    'rgba(16, 185, 129, 0.7)',
                    'rgba(168, 85, 247, 0.7)',
                    'rgba(234, 179, 8, 0.7)',
                    'rgba(239, 68, 68, 0.7)',
                    'rgba(99, 102, 241, 0.7)',
                ],
            },
        ],
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="h-[calc(100vh-100px)] space-y-8 overflow-auto p-6">
                {/* 🔹 Top KPI Cards */}
                <div className="grid gap-4 md:grid-cols-3 xl:grid-cols-6">
                    {[
                        { label: 'Users', value: stats.users, icon: 'fa-user-graduate', color: 'text-green-500' },
                        { label: 'Pages', value: stats.pages, icon: 'fa-solid fa-file-lines', color: 'text-blue-500' },
                        { label: 'Teams', value: stats.teams, icon: 'fa-calendar-days', color: 'text-red-500' },
                        { label: 'Our Locations', value: stats.officeLocations, icon: 'fa-solid fa-map-location-dot', color: 'text-pink-500' },
                        { label: 'Projects', value: stats.projects, icon: 'fa-user-graduate', color: 'text-green-500' },
                        { label: 'Services', value: stats.services, icon: 'fa-solid fa-truck-fast', color: 'text-orange-500' },
                        { label: 'Appointments', value: stats.appointments, icon: 'fa-solid fa-truck-fast', color: 'text-orange-500' },

                        { label: 'Job Circulars', value: stats.jobCirculars, icon: 'fa-calendar-days', color: 'text-red-500' },
                        { label: 'Products', value: stats.products, icon: 'fa-box-open', color: 'text-purple-500' },
                        { label: 'Orders', value: stats.orders, icon: 'fa-box-open', color: 'text-purple-500' },
                        { label: 'Payments', value: stats.payments, icon: 'fa-box-open', color: 'text-purple-500' },
                        { label: 'Students', value: stats.students, icon: 'fa-user-graduate', color: 'text-green-500' },
                    ].map((stat, idx) => (
                        <div
                            key={idx}
                            className="flex items-center rounded-xl border border-sidebar-border/70 bg-white p-4 shadow-sm dark:border-sidebar-border dark:bg-neutral-900"
                        >
                            {/* Icon on the left */}
                            <i className={`fa-solid ${stat.icon} ${stat.color} mr-6 text-3xl`} />

                            {/* Text block */}
                            <div>
                                <div className="text-2xl font-bold">{stat.value}</div>
                                <div className="text-sm text-gray-500">{stat.label}</div>
                            </div>
                        </div>
                    ))}
                </div>

                {/* 🔹 Graphs */}
                <div className="grid gap-4 md:grid-cols-12">
                    {/* Left chart: 40% → span 4 of 10 */}
                    <div className="col-span-10 rounded-xl border border-sidebar-border/70 bg-white p-4 shadow-sm md:col-span-4 dark:border-sidebar-border dark:bg-neutral-900">
                        <h2 className="mb-3 text-lg font-semibold">Monthly Visitors</h2>
                        <Line data={monthlyVisitorsData} />
                    </div>

                    {/* Right chart: 60% → span 6 of 10 */}
                    <div className="col-span-10 rounded-xl border border-sidebar-border/70 bg-white p-4 shadow-sm md:col-span-4 dark:border-sidebar-border dark:bg-neutral-900">
                        <h2 className="mb-3 text-lg font-semibold">Top Visited Pages</h2>
                        <Bar data={routeVisitedData} />
                    </div>

                    {/* Right chart: 60% → span 6 of 10 */}
                    <div className="col-span-10 rounded-xl border border-sidebar-border/70 bg-white p-4 shadow-sm md:col-span-4 dark:border-sidebar-border dark:bg-neutral-900">
                        <h2 className="mb-3 text-lg font-semibold">Today's Top Visited Pages</h2>
                        <Bar data={routeVisitedData} />
                    </div>
                </div>

                <div className="grid gap-4 md:grid-cols-12">
                    {/* Left chart: 40% → span 4 of 10 */}
                    <div className="col-span-10 rounded-xl border border-sidebar-border/70 bg-white p-4 shadow-sm md:col-span-4 dark:border-sidebar-border dark:bg-neutral-900">
                        <h2 className="mb-3 text-lg font-semibold">Monthly Orders</h2>
                        <Line data={monthlyVisitorsData} />
                    </div>

                    {/* Left chart: 40% → span 4 of 10 */}
                    <div className="col-span-10 rounded-xl border border-sidebar-border/70 bg-white p-4 shadow-sm md:col-span-4 dark:border-sidebar-border dark:bg-neutral-900">
                        <h2 className="mb-3 text-lg font-semibold">Monthly Appointments</h2>
                        <Line data={monthlyVisitorsData} />
                    </div>

                    {/* Left chart: 40% → span 4 of 10 */}
                    <div className="col-span-10 rounded-xl border border-sidebar-border/70 bg-white p-4 shadow-sm md:col-span-4 dark:border-sidebar-border dark:bg-neutral-900">
                        <h2 className="mb-3 text-lg font-semibold">Monthly Inventory Logs</h2>
                        <Line data={monthlyVisitorsData} />
                    </div>
                </div>

                <div className="grid gap-4 md:grid-cols-12">
                    {/* Left chart: 40% → span 4 of 10 */}
                    <div className="col-span-10 rounded-xl border border-sidebar-border/70 bg-white p-4 shadow-sm md:col-span-4 dark:border-sidebar-border dark:bg-neutral-900">
                        <h2 className="mb-3 text-lg font-semibold">Sales</h2>
                        <Line data={monthlyVisitorsData} />
                    </div>

                    {/* Left chart: 40% → span 4 of 10 */}
                    <div className="col-span-10 rounded-xl border border-sidebar-border/70 bg-white p-4 shadow-sm md:col-span-4 dark:border-sidebar-border dark:bg-neutral-900">
                        <h2 className="mb-3 text-lg font-semibold">Cupon Log</h2>
                        <Line data={monthlyVisitorsData} />
                    </div>

                    {/* Left chart: 40% → span 4 of 10 */}
                    <div className="col-span-10 rounded-xl border border-sidebar-border/70 bg-white p-4 shadow-sm md:col-span-4 dark:border-sidebar-border dark:bg-neutral-900">
                        <h2 className="mb-3 text-lg font-semibold">Monthly Inventory Logs</h2>
                        <Line data={monthlyVisitorsData} />
                    </div>
                </div>

                {/* 🔹 Recent Content */}
                <div className="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                    <div className="rounded-xl border border-sidebar-border/70 bg-white p-4 shadow-sm dark:border-sidebar-border dark:bg-neutral-900">
                        <h2 className="mb-3 text-lg font-semibold">Latest Notices</h2>
                        <ul className="space-y-2 text-sm">
                            {latestNotices.map((notice: any) => (
                                <li key={notice.id} className="flex justify-between">
                                    <span>{notice.title}</span>
                                    <span className="text-gray-500">{new Date(notice.created_at).toLocaleDateString()}</span>
                                </li>
                            ))}
                        </ul>
                    </div>

                    <div className="rounded-xl border border-sidebar-border/70 bg-white p-4 shadow-sm dark:border-sidebar-border dark:bg-neutral-900">
                        <h2 className="mb-3 text-lg font-semibold">Recent Job Applications</h2>
                        <ul className="space-y-2 text-sm">
                            {applications.map((a: any) => (
                                <li key={a.id} className="flex justify-between">
                                    <span>{a.name}</span>
                                    <span className="text-gray-500">{a.position}</span>
                                </li>
                            ))}
                        </ul>
                    </div>

                    <div className="rounded-xl border border-sidebar-border/70 bg-white p-4 shadow-sm dark:border-sidebar-border dark:bg-neutral-900">
                        <h2 className="mb-3 text-lg font-semibold">Recent Media Uploads</h2>
                        <div className="grid grid-cols-3 gap-2">
                            {media.map((m: any) => (
                                <MediaPreview key={m.id} media={m} imgHeight="h-20" videoHeight="h-20" embedHeight="h-20" />
                                // <img key={m.id} src={m.url} alt="" className="h-20 w-full rounded object-cover" />
                            ))}
                        </div>
                    </div>
                </div>

                {/* 🔹 Quick Actions */}
                <div className="rounded-xl border border-sidebar-border/70 bg-white p-4 shadow-sm dark:border-sidebar-border dark:bg-neutral-900">
                    <h2 className="mb-3 text-lg font-semibold">Quick Actions</h2>
                    <div className="flex flex-wrap gap-2">
                        {[
                            { label: 'Add Blog', icon: 'fa-newspaper' },
                            { label: 'Add Product', icon: 'fa-box-open' },
                            { label: 'Add Service', icon: 'fa-cogs' },
                            { label: 'Add Notice', icon: 'fa-bullhorn' },
                            { label: 'Add Event', icon: 'fa-calendar-plus' },
                        ].map((action, idx) => (
                            <button
                                key={idx}
                                className="flex items-center gap-2 rounded-lg bg-blue-500 px-4 py-2 text-sm text-white hover:bg-blue-600"
                            >
                                <i className={`fa-solid ${action.icon}`} />
                                {action.label}
                            </button>
                        ))}
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
